<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210806182325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_specialite_enseignant (user_id INT NOT NULL, specialite_enseignant_id INT NOT NULL, INDEX IDX_A6B719CBA76ED395 (user_id), INDEX IDX_A6B719CB296B83CB (specialite_enseignant_id), PRIMARY KEY(user_id, specialite_enseignant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_specialite_enseignant ADD CONSTRAINT FK_A6B719CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_specialite_enseignant ADD CONSTRAINT FK_A6B719CB296B83CB FOREIGN KEY (specialite_enseignant_id) REFERENCES specialitedesenseignants (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_specialite');
        $this->addSql('ALTER TABLE pfe DROP specialite, CHANGE id_etudiant id_etudiant VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE specialite_pfe ADD PRIMARY KEY (pfe_id, specialite_id)');
        $this->addSql('ALTER TABLE specialite_pfe ADD CONSTRAINT FK_7387E7DB396A359C FOREIGN KEY (pfe_id) REFERENCES pfe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite_pfe ADD CONSTRAINT FK_7387E7DB2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialitedespfes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsable CHANGE filiere filiere VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE specialitedesenseignants CHANGE nom nom VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_specialite (user_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_40B13A2D2195E0F0 (specialite_id), INDEX IDX_40B13A2DA76ED395 (user_id), PRIMARY KEY(user_id, specialite_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_specialite ADD CONSTRAINT FK_40B13A2DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_specialite_enseignant');
        $this->addSql('ALTER TABLE pfe ADD specialite VARCHAR(200) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE id_etudiant id_etudiant VARCHAR(50) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE responsable CHANGE filiere filiere VARCHAR(500) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE specialite_pfe DROP FOREIGN KEY FK_7387E7DB396A359C');
        $this->addSql('ALTER TABLE specialite_pfe DROP FOREIGN KEY FK_7387E7DB2195E0F0');
        $this->addSql('ALTER TABLE specialite_pfe DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE specialitedesenseignants CHANGE nom nom VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
    }
}
