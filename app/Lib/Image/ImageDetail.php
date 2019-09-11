<?php
/**
 * Created by : RABIN BHANDARI.
 * Created On : 11/22/2017
 *
 * THIS INTELECTUAL PROPERTY IS COPYRIGHT © 2017
 * DATATRAX PUBLISHING SYSTEMS, INC. ALL RIGHTS RESERVED
*/

namespace App\Lib\Image;


class ImageDetail
{

    private $image = "";
    private $unit = "PX";
    var $detail = [];
    private $dimentions = [];
    private $process = false;
    private $allwed_unit = ["PX", "INCH", "MM", "CM", "PERCENT"];

    /**
     * ImageDetail constructor.
     * @param $image
     */
    public function __construct($image)
    {
        if($image) {
            $this->process = extension_loaded('gd');
            if ($this->process) {
                $this->image = $image;
                $this->dimentions = getimagesize($this->image);
                $this->prepareDetail();
            } else {
                $this->prepareDetail(true);
            }
        }
    }

    /**
     * return Height , Width
     * @param bool $unit
     * @return array|bool
     */
    public function getWH($unit = false)
    {
        $this->unit = $unit ? strtoupper($unit) : $this->unit;
        if ($this->unit !== "PX") {
            return $this->unitConvertor($this->unit);
        } else {
            return [
                "width" => $this->dimentions[0],
                "height" => $this->dimentions[1]
            ];
        }

    }

    /**
     * @unit bytes
     * @return int
     */
    protected function getSize()
    {
        return (int)ceil(filesize($this->image) / 1024);
    }


    /**
     * @return array
     */
    protected function getDPI()
    {
        $horizontal_dpi =  (int) floor($this->getWH("px")["width"] / $this->getWH("inch")["width"]);
        $vertial_dpi =  (int) floor($this->getWH("px")["height"] / $this->getWH("inch")["height"]);
        return array("w" => $horizontal_dpi, "h" => $vertial_dpi);
    }

    /**
     * @param bool $unit
     * @return array
     */
    protected function unitConvertor($unit = false)
    {
        $return_unit = "px";
        $width = "";
        $height = "";
        $round = 2;
        if (in_array($unit, $this->allwed_unit)) {
            switch ($unit) {
                case "MM":
                    $width = round(($this->dimentions[0] * 0.26458330246528137905050577744099), $round);
                    $height = round(($this->dimentions[1] * 0.26458330246528137905050577744099), $round);
                    break;

                case "INCH":
                    $width = round(($this->dimentions[0] * 0.01041666666666666666666666666667), $round);
                    $height = round(($this->dimentions[1] * 0.01041666666666666666666666666667), $round);
                    break;

                case "CM":
                    $width = round(($this->dimentions[0] * 0.02645833304670139199406825339759), $round);
                    $height = round(($this->dimentions[1] * 0.02645833304670139199406825339759), $round);
                    break;
            }

            return [
                "unit" => $return_unit,
                "width" => $width,
                "height" => $height
            ];
        }
    }


    /**
     * @param bool $exit
     * @return array|string
     */
    public function prepareDetail($exit = false)
    {
        if ($exit) {
            return $this->detail["error"] = "GD module is not loaded";
        }
        $this->detail["image"]      = $this->image;
        $this->detail["wh"]         = $this->getWH();
        $this->detail["size"]       = $this->getSize();
        $this->detail["bits"]       = isset($this->dimentions["bits"]) ? $this->dimentions["bits"] : false;
        $this->detail["mime"]       = isset($this->dimentions["mime"]) ? $this->dimentions["mime"] : false;
        $this->detail["channels"]   = isset($this->dimentions["channels"]) ? $this->dimentions["channels"] : false;
        $this->detail["extention"]  = pathinfo($this->image, PATHINFO_EXTENSION);
        $this->detail["dpi"]        = $this->getDPI();
        return $this->detail;
    }

}