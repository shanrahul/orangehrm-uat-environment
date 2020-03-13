<?php


class WebContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

  public function checkContainerIsRunning(UnitTester $I){
        $I->wantTo("verify ubuntu container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} flash_web");
        $I->seeInShellOutput("true");
    }


    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 7.3 is installed in the container");
        $I->runShellCommand("docker exec flash_web php --version");
        $I->seeInShellOutput('PHP 7.3');
    }

    public function checkForNologinFile(UnitTester $I){
        $I->wantTo("verify nologin file is not there");
        $I->runShellCommand("docker exec flash_web ls /var/run/");
        $I->dontSeeInShellOutput("nologin");
    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec flash_web service crond status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkMemcacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand("docker exec flash_web service memcached status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkSSHInstallation(UnitTester $I){
            $I->wantTo("verify OpenSSH is installed in the container");
            $I->runShellCommand("docker exec flash_web rpm -qa | grep openssh-server");
            $I->seeInShellOutput("openssh-server-7");
    }

    public function checkSSHServiceRunning(UnitTester $I){
            $I->wantTo("verify ssh is up and running in the container");
            $I->runShellCommand("docker exec flash_web service sshd status");
            $I->seeInShellOutput('active (running)');
    }

    public function checkNSSPAMLDAPInstallation(UnitTester $I){
            $I->wantTo("verify nss-pam-ldapd is installed in the container");
            $I->runShellCommand("docker exec flash_web rpm -qa | grep nss-pam-ldapd");
            $I->seeInShellOutput("nss-pam-ldapd-0.8");
    }

    public function checkOpenldapInstallation(UnitTester $I){
            $I->wantTo("verify open-ldap is installed in the container");
            $I->runShellCommand("docker exec flash_web rpm -qa | grep openldap");
            $I->seeInShellOutput("openldap-clients-2");
    }

    public function checkNSCDInstallation(UnitTester $I){
            $I->wantTo("verify nscd is installed in the container");
            $I->runShellCommand("docker exec flash_web rpm -qa | grep nscd");
            $I->seeInShellOutput("nscd-2");
    }

    public function checkJavaVersion(UnitTester $I){
            $I->wantTo("verify java is installed in the container");
            $I->runShellCommand("docker exec flash_web rpm -qa | grep java-1.8.0-openjdk");
            $I->seeInShellOutput("java-1.8.0");
    }

    public function checkWgetVersion(UnitTester $I){
            $I->wantTo("verify wget is installed in the container");
            $I->runShellCommand("docker exec flash_web rpm -qa | grep wget");
            $I->seeInShellOutput("wget-1");
    }

    public function checkRabbitMqStatus(UnitTester $I){
        $I->wantTo("verify docker is listening to rabbitMq queues");
        $I->runShellCommand("netstat -ltpn | grep 6991");
        $I->seeInShellOutput("6991");
    }

    public function checkRabbitMqManagementPlugin(UnitTester $I){
        $I->wantTo("verify docker is listening to rabbitMq management plugin");
        $I->runShellCommand("netstat -ltpn | grep 6990");
        $I->seeInShellOutput("6990");
    }

    public function checkSendMailNoArch(UnitTester $I){
        $I->wantTo("verify wether sendmail noarch is installed");
        $I->runShellCommand("docker exec flash_web yum list installed | grep sendmail");
        $I->seeInShellOutput("sendmail-cf.noarch");
    }

}
