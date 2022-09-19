<?php

class DrawerEngine {
    const PARAMETER_NAME = 'num';
    const SHAPE_MASK = [0b11000000, 6];
    const COLOR_MASK = [0b00110000, 4];
    const WIDTH_MASK = [0b00001100, 2];
    const HEIGHT_MASK = [0b00000011, 0];
    const CIRCLE = 0b00;
    const SQUARE = 0b01;
    const TRIANGLE = 0b10;
    const REVTRIANGLE = 0b11;
    const COLORS = [
        0b00 => 'Salmon',
        0b01 => 'YellowGreen',
        0b10 => 'Indigo',
        0b11 => 'DarkTurquoise'
    ];

    private int $shape;
    private string $color;
    private int $width;
    private int $height;

    public function __construct(int $encoded) {
        $this->shape = ($encoded & self::SHAPE_MASK[0]) >> self::SHAPE_MASK[1];
        $this->color = self::COLORS[($encoded & self::COLOR_MASK[0]) >> self::COLOR_MASK[1]];
        $this->width = ((($encoded & self::WIDTH_MASK[0]) >> self::WIDTH_MASK[1]) + 1) * 100;
        $this->height = ((($encoded & self::HEIGHT_MASK[0]) >> self::HEIGHT_MASK[1]) + 1) * 100;
        $this->paint();
    }

    private function paint() {
        $halfWidth = $this->width / 2;
        $halfHeight = $this->height / 2;
        switch ($this->shape) {
            case self::CIRCLE:
                $figure = <<<A
                    <ellipse  
                        cx="$halfWidth" 
                        cy="$halfHeight" 
                        rx="$halfWidth" 
                        ry="$halfHeight" 
                        fill="$this->color"
                        stroke="black"
                        stroke-width="5"/>
                A;
                break;
            case self::SQUARE:
                $figure = <<<B
                    <rect 
                        width="$this->width" 
                        height="$this->height" 
                        fill="$this->color"
                        stroke="black"
                        stroke-width="5"/>
                B;
                break;
            case self::TRIANGLE:
                $figure = <<<C
                    <polygon 
                        points="$this->width,$this->height 0,0 0,$this->height" 
                        fill="$this->color"
                        stroke="black"
                        stroke-width="5"/>
                C;
                break;
            case self::REVTRIANGLE:
                $figure = <<<D
                    <polygon 
                        points="$this->width,$this->height $this->width,0 0,$this->height" 
                        fill="$this->color"
                        stroke="black"
                        stroke-width="5"/>
                D;
                break;
            default:
                throw new Exception("Wrong input");
        }
        echo <<<E
        <svg 
            width="$this->width"
            height="$this->height">
            $figure
        </svg>                
        E;
    }
}

?>