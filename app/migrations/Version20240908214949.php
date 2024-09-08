<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240908214949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id UUID NOT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, age INT NOT NULL, phone VARCHAR(255) NOT NULL, fico_score INT NOT NULL, ssn VARCHAR(255) NOT NULL, monthly_income NUMERIC(10, 2) DEFAULT NULL, address_city VARCHAR(100) NOT NULL, address_zip_code VARCHAR(10) NOT NULL, address_state SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN clients.id IS \'(DC2Type:client_uuid)\'');
        $this->addSql('COMMENT ON COLUMN clients.email IS \'(DC2Type:client_email)\'');
        $this->addSql('COMMENT ON COLUMN clients.first_name IS \'(DC2Type:client_name)\'');
        $this->addSql('COMMENT ON COLUMN clients.last_name IS \'(DC2Type:client_name)\'');
        $this->addSql('COMMENT ON COLUMN clients.age IS \'(DC2Type:client_age)\'');
        $this->addSql('COMMENT ON COLUMN clients.phone IS \'(DC2Type:client_phone)\'');
        $this->addSql('COMMENT ON COLUMN clients.fico_score IS \'(DC2Type:client_fico_score)\'');
        $this->addSql('COMMENT ON COLUMN clients.ssn IS \'(DC2Type:client_number)\'');
        $this->addSql('COMMENT ON COLUMN clients.monthly_income IS \'(DC2Type:client_quantity)\'');
        $this->addSql('COMMENT ON COLUMN clients.address_city IS \'(DC2Type:client_city)\'');
        $this->addSql('COMMENT ON COLUMN clients.address_zip_code IS \'(DC2Type:client_zip_code)\'');
        $this->addSql('COMMENT ON COLUMN clients.address_state IS \'(DC2Type:client_state)\'');
        $this->addSql('CREATE TABLE loans (id UUID NOT NULL, client_id UUID NOT NULL, name VARCHAR(255) NOT NULL, term INT NOT NULL, interest_rate NUMERIC(4, 2) NOT NULL, amount NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN loans.id IS \'(DC2Type:loan_uuid)\'');
        $this->addSql('COMMENT ON COLUMN loans.client_id IS \'(DC2Type:loan_uuid)\'');
        $this->addSql('COMMENT ON COLUMN loans.name IS \'(DC2Type:loan_name)\'');
        $this->addSql('COMMENT ON COLUMN loans.term IS \'(DC2Type:loan_term)\'');
        $this->addSql('COMMENT ON COLUMN loans.interest_rate IS \'(DC2Type:loan_rate)\'');
        $this->addSql('COMMENT ON COLUMN loans.amount IS \'(DC2Type:loan_amount)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE loans');
    }
}
