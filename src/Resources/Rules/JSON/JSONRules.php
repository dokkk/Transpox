<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:55
 */

namespace Transpox\Resources\Rules\JSON;


use Transpox\Resources\AbstractFile;
use Transpox\Resources\Rules\EmptyTargetsException;
use Transpox\Resources\Rules\EmptyRulesException;
use Transpox\Resources\Rules\EmptySourcesException;
use Transpox\Resources\Rules\RedundantTargetsException;
use Transpox\Resources\Rules\RedundantSourcesException;
use Transpox\Resources\Rules\RulesInterface;

class JSONRules extends AbstractFile implements RulesInterface
{
    /** @var \stdClass|null $sources */
    private $sources;

    /** @var \stdClass|null $targets */
    private $targets;

    /** @var \stdClass|null $rules */
    private $rules;

    /** @var array $sourceValues */
    private $sourceValues;

    /** @var string $sourceValuesType */
    private $sourceValuesType;

    /** @var array $targetsValues */
    private $targetsValues;

    /** @var string $targetsValuesType */
    private $targetsValuesType;

    /** @var string VALUES_NAMES */
    const VALUES_NAMES = "N";

    /** @var string VALUES_POSITION */
    const VALUES_POSITIONS = "P";

    /** @inheritdoc
     * @param string $fileName
     * @throws BadJSONException
     * @throws EmptyJSONRulesFileException
     * @throws EmptySourcesException
     * @throws EmptyTargetsException
     * @throws EmptyRulesException
     * @throws RedundantSourcesException
     * @throws RedundantTargetsException
     */
    public function __construct($fileName)
    {
        parent::__construct($fileName);
        $content = $this->getFileContent();
        if (empty($content)) {
            throw new EmptyJSONRulesFileException('The Rules file cannot be empty');
        }
        $content = json_decode($content);
        if ($content == null ||
            !is_object($content) ||
            empty((array)$content)) {
            throw new BadJSONException('The Rules files contains bad JSON data');
        }

        $this->sources = property_exists($content, 'sources') ? $content->sources : null;
        $this->checkSources();

        $this->targets = property_exists($content, 'targets') ? $content->targets : null;
        $this->checkTargets();

        $this->rules = property_exists($content, 'rules') ? $content->rules : null;
        $this->checkRules();

        $this->setSourceValues();
        $this->setTargetsValues();
    }

    /** @inheritdoc */
    public function getSources()
    {
        return $this->sourceValues;
    }

    /**
     * @return string
     */
    public function getSourcesIdentifierType()
    {
        return $this->sourceValuesType;
    }

    /** @inheritdoc */
    public function getTargets()
    {
        return $this->targetsValues;
    }

    /**
     * @return string
     */
    public function getTargetsIdentifierType()
    {
        return $this->targetsValuesType;
    }

    /** @inheritdoc */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * check if the sources contains any value
     * @throws EmptySourcesException
     * @throws RedundantSourcesException
     */
    protected function checkSources()
    {
        if (!empty($this->sources)) {
            if (empty($this->sources->names) && empty($this->sources->positions)) {
                throw new EmptySourcesException('The Rules file contains empty sources');
            }
            if (!empty($this->sources->names) && !empty($this->sources->positions)) {
                throw new RedundantSourcesException('The Rules file contains sources with both names and positions');
            }
        }
    }

    /**
     * check if the targets contain any value
     * @throws EmptyTargetsException
     * @throws RedundantTargetsException
     */
    protected function checkTargets()
    {
        if (!empty($this->targets)) {
            if (empty($this->targets->names) && empty($this->targets->positions)) {
                throw new EmptyTargetsException('The Rules file contains empty targets');
            }
            if (!empty($this->targets->names) && !empty($this->targets->positions)) {
                throw new RedundantTargetsException('The Rules file contains targets with both names and positions');
            }
        }
    }

    /**
     * check if there the rules contains any value
     * @throws EmptyRulesException
     */
    protected function checkRules()
    {
        if (!empty($this->rules) && empty((array)$this->rules)) {
            throw new EmptyRulesException('The Rules file contains no rules');
        }
    }

    /**
     * set the source fields values and type, depending on if names or positions are set
     */
    protected function setSourceValues()
    {
        if (!empty($this->sources)) {
            if (!empty($this->sources->names)) {
                $this->sourceValues = $this->sources->names;
                $this->sourceValuesType = static::VALUES_NAMES;
            } else {
                $this->sourceValues = $this->sources->positions;
                $this->sourceValuesType = static::VALUES_POSITIONS;
            }
        }
    }

    /**
     * set the source fields values and type, depending on if names or positions are set
     */
    protected function setTargetsValues()
    {
        if (!empty($this->targets)) {
            if (!empty($this->targets->names)) {
                $this->targetsValues = $this->targets->names;
                $this->targetsValuesType = static::VALUES_NAMES;
            } else {
                $this->targetsValues = $this->targets->positions;
                $this->targetsValuesType = static::VALUES_POSITIONS;
            }
        }
    }
}