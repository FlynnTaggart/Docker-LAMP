<?php

class AddEngine {
    public function __construct(string $command) {
        $command = trim($_POST["command"]);
        if (!in_array($command, $this->allowed_commands)){
            echo "Wrong or not allowed command";
        }
        else {
            $output = shell_exec($command);
            echo "<pre>$output</pre>";
        }
    }
}

?>