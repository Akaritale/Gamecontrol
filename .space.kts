/**
* JetBrains Space Automation
* This Kotlin-script file lets you automate build activities
* For more info, see https://www.jetbrains.com/help/space/automation.html
*/

job("Build & Run") {
    container(displayName = "Composer", image = "composer:2") {
     	args("compsoer", "install", "--no-dev", "--ignore-platform-reqs", "--no-interaction")
    }
    
    container(displayName = "PHP 7.4", image = "php:7.4") {
     	args("php", "-f cli.php", "help")   
    }
}
