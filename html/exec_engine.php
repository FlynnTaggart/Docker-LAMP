<?php

class ExecEngine {
    private $allowed_commands = ["ls", "ls -a", "ls -al", "ls -l",
    "ps", "ps -a", "ps -al", "ps -l", 
    "whoami", "uname", "uname -a", 
    "id", "pwd"];
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