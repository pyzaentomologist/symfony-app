<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230805164640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD reporting_systems VARCHAR(255) DEFAULT NULL, ADD project_methodologies VARCHAR(255) DEFAULT NULL, DROP report_systems, DROP project_management_methods');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD report_systems VARCHAR(255) DEFAULT NULL, ADD project_management_methods VARCHAR(255) DEFAULT NULL, DROP reporting_systems, DROP project_methodologies');
    }
}
