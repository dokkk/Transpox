<?php

namespace Transpox\Handles;

class SourceHandle extends AbstractHandle
{
    /**
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @return resource
     */
    public function transpose(): resource
    {
        $destinationWriter = $this->getDestinationWriter();
        $meta_data = stream_get_meta_data($this->destinationFile);
        $filename = $meta_data["uri"];
        $destinationWriter->save($filename);
        return $this->destinationFile;
    }
}