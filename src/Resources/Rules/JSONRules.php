<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:55
 */

namespace Transpox\Resources\Rules;


use Transpox\Resources\AbstractFile;
use Transpox\Resources\BadJSONException;

class JSONRules extends AbstractFile implements RulesInterface
{
    private $sources;
    private $destinations;
    private $rules;

    /** @inheritdoc
     * @param $file
     * @throws BadJSONException
     * @throws EmptyRulesException
     */
    public function __construct($file)
    {
        parent::__construct($file);
        $content = stream_get_contents($file);
        if (empty($content)) {
            throw new EmptyRulesException('The Rules file cannot be empty');
        }
        $content = json_decode(stream_get_contents($file));
        if ($content == null || strtoupper($content) == 'NULL') {
            throw new BadJSONException('The Rules files contains bad JSON data');
        }
        $this->sources = $content->sources;
        $this->destinations = $content->destinations;
        $this->rules = $content->rules;
    }

    /** @inheritdoc */
    public function getSources()
    {
        return $this->sources;
    }

    /** @inheritdoc */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /** @inheritdoc */
    public function getRules()
    {
        return $this->rules;
    }
}