<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230805130759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_manager DROP FOREIGN KEY FK_6C3A29DC9D86650F');
        $this->addSql('ALTER TABLE tester DROP FOREIGN KEY FK_FC5056459D86650F');
        $this->addSql('ALTER TABLE developer DROP FOREIGN KEY FK_65FB8B9A9D86650F');
        $this->addSql('DROP TABLE project_manager');
        $this->addSql('DROP TABLE tester');
        $this->addSql('DROP TABLE developer');
        $this->addSql('ALTER TABLE user ADD testing_systems VARCHAR(255) DEFAULT NULL, ADD report_systems VARCHAR(255) DEFAULT NULL, ADD selenium_knowledge TINYINT(1) DEFAULT NULL, ADD project_management_methods VARCHAR(255) DEFAULT NULL, ADD scrum_knowledge TINYINT(1) DEFAULT NULL, ADD ide_environments VARCHAR(255) DEFAULT NULL, ADD programming_languages VARCHAR(255) DEFAULT NULL, ADD mysql_knowledge TINYINT(1) DEFAULT NULL, CHANGE name first_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_manager (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, project_management_methods VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, report_systems VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, scrum_knowledge TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_6C3A29DC9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tester (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, testing_systems VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, report_systems VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, selenium_knowledge TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_FC5056459D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE developer (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, ide_environments VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, programming_languages VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, mysql_knowledge TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_65FB8B9A9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE project_manager ADD CONSTRAINT FK_6C3A29DC9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tester ADD CONSTRAINT FK_FC5056459D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE developer ADD CONSTRAINT FK_65FB8B9A9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user DROP testing_systems, DROP report_systems, DROP selenium_knowledge, DROP project_management_methods, DROP scrum_knowledge, DROP ide_environments, DROP programming_languages, DROP mysql_knowledge, CHANGE first_name name VARCHAR(255) NOT NULL');
    }
}
