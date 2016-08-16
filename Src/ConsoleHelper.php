<?php

namespace Ysgen\Src;

/**
 * A class providing basic helper functions
 */
class ConsoleHelper
{
    private $argv;
    private $calledDirectory;
    private $subject;


    /**
     * Constructor
     * @param array $argv
     */
    public function __construct($argv)
    {
        $this->argv = $argv;
        $this->calledDirectory = $argv[0];
        $this->subject = $argv[1];
    }

    /**
     * Generate project structure
     */
    public function generate()
    {
        $argv = $this->argv;

        if (isset($argv[3])) {
            $parser = new StructureParser(TEMPLATES_DIR . '/' . $argv[3] . '.yml');
        } else {
            $parser = new StructureParser();
        }

        $parser->generate();
    }

    /**
     * Save a template
     */
    public function save()
    {
        $argv = $this->argv;

        $overwrite = (isset($argv[4]) && (strtolower($argv[4] === 'overwrite')));
        $saver = new StructureSaver($argv[3], $overwrite);

        $saver->save();
    }

    /**
     * List all saves
     */
    public function list()
    {
        $files = scandir(TEMPLATES_DIR);
        unset($files[0]);
        unset($files[1]);
        echo 'Available template files:' . PHP_EOL;
        echo implode(PHP_EOL, $files);
    }
}