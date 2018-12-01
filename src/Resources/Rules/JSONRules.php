<?php
/**
 * Created by dcaruso.
 * Date: 04.11.18
 * Time: 23:55
 */

namespace Transpox\Resources\Rules;


use Transpox\Resources\AbstractFile;

class JSONRules extends AbstractFile implements RulesInterface
{
    private $content;
    private $sources;
    private $destinations;
    private $rules;

    /** @inheritdoc */
    public function __construct($file)
    {
        parent::__construct($file);
        //TO DO: $file is a resource, convert it?
        $this->content = json_decode(stream_get_contents($file));
        $this->sources = $this->content->sources;
        $this->destinations = $this->content->destinations;
        $this->rules = $this->content->rules;
    }

    /**
     * Return all the rules
     * @return mixed
     */
    public function getAll()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @return mixed
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }
}