<?php


class MysqlContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

    // tests
    public function mySqlContainerTest(UnitTester $I){
        $I->wantTo("verify mysql container is up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} guardian_mysql");
        $I->seeInShellOutput("true");
    }

    public function checkMySQLServiceIsRunning(AcceptanceTester $I){
        $I->wantTo("verify mariadb 10.2 service is up and running");
        $I->runShellCommand("ping -c 30 localhost");
        $I->runShellCommand("docker exec guardian_mysql mysqladmin -uroot -p1234 status");
        $I->seeInShellOutput("Uptime");
    }

    public function rabbitmqContainerTest(UnitTester $I){
        $I->wantTo("verify rabbitmq container is up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} guardian_rabbitmq");
        $I->seeInShellOutput("true");
    }

}
