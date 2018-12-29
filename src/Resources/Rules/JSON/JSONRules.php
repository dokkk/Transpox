<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:55
 */

namespace Transpox\Resources\Rules\JSON;


use Transpox\Resources\AbstractFile;
use Transpox\Resources\Rules\EmptyDestinationsException;
use Transpox\Resources\Rules\EmptyRulesException;
use Transpox\Resources\Rules\EmptySourcesException;
use Transpox\Resources\Rules\RedundantDestinationsException;
use Transpox\Resources\Rules\RedundantSourcesException;
use Transpox\Resources\Rules\RulesInterface;

class JSONRules extends AbstractFile implements RulesInterface
{
    /** @var \stdClass|null $sources */
    private $sources;

    /** @var \stdClass|null $destinations */
    private $destinations;

    /** @var \stdClass|null $rules */
    private $rules;

    /** @var array $sourceValues */
    private $sourceValues;

    /** @var string $sourceValuesType */
    private $sourceValuesType;

    /** @var array $destinationValues */
    private $destinationValues;

    /** @var string $destinationValuesType */
    private $destinationValuesType;

    /** @var string VALUES_NAMES */
    const VALUES_NAMES = "N";

    /** @var string VALUES_POSITION */
    const VALUES_POSITIONS = "P";

    /** @inheritdoc
     * @param string $fileName
     * @throws BadJSONException
     * @throws EmptyJSONRulesFileException
     * @throws EmptySourcesException
     * @throws EmptyDestinationsException
     * @throws EmptyRulesException
     * @throws RedundantSourcesException
     * @throws RedundantDestinationsException
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

        $this->destinations = property_exists($content, 'destinations') ? $content->destinations : null;
        $this->checkDestinations();

        $this->rules = property_exists($content, 'rules') ? $content->rules : null;
        $this->checkRules();

        $this->setSourceValues();
        $this->setDestinationValues();
    }

    /** @inheritdoc */
    public function getSources()
    {
        return $this->sourceValues;
    }

    /**
     * @return string
     */
    public function getSourceType()
    {
        return $this->sourceValuesType;
    }

    /** @inheritdoc */
    public function getDestinations()
    {
        return $this->destinationValues;
    }

    /**
     * @return string
     */
    public function getDestinationType()
    {
        return $this->destinationValuesType;
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
     * check if the destinations contains any value
     * @throws EmptyDestinationsException
     * @throws RedundantDestinationsException
     */
    protected function checkDestinations()
    {
        if (!empty($this->destinations)) {
            if (empty($this->destinations->names) && empty($this->destinations->positions)) {
                throw new EmptyDestinationsException('The Rules file contains empty destinations');
            }
            if (!empty($this->destinations->names) && !empty($this->destinations->positions)) {
                throw new RedundantDestinationsException('The Rules file contains destination swith both names and positions');
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
    protected function setDestinationValues()
    {
        if (!empty($this->destinations)) {
            if (!empty($this->destinations->names)) {
                $this->destinationValues = $this->destinations->names;
                $this->destinationValuesType = static::VALUES_NAMES;
            } else {
                $this->destinationValues = $this->destinations->positions;
                $this->destinationValuesType = static::VALUES_POSITIONS;
            }
        }
    }
}