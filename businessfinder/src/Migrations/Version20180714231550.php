<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180714231550 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE business (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(192) NOT NULL, telephone VARCHAR(192) NOT NULL, address VARCHAR(192) NOT NULL, postal_code VARCHAR(192) NOT NULL, city VARCHAR(192) NOT NULL, state VARCHAR(2) NOT NULL, description VARCHAR(192) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business_business_category (business_id INT NOT NULL, business_category_id INT NOT NULL, INDEX IDX_E64919EEA89DB457 (business_id), INDEX IDX_E64919EE5382448A (business_category_id), PRIMARY KEY(business_id, business_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(192) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_business_category ADD CONSTRAINT FK_E64919EEA89DB457 FOREIGN KEY (business_id) REFERENCES business (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE business_business_category ADD CONSTRAINT FK_E64919EE5382448A FOREIGN KEY (business_category_id) REFERENCES business_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE business_business_category DROP FOREIGN KEY FK_E64919EEA89DB457');
        $this->addSql('ALTER TABLE business_business_category DROP FOREIGN KEY FK_E64919EE5382448A');
        $this->addSql('DROP TABLE business');
        $this->addSql('DROP TABLE business_business_category');
        $this->addSql('DROP TABLE business_category');
    }
}
