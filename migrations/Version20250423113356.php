<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423113356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE foto_ruta (id INT AUTO_INCREMENT NOT NULL, id_ruta_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, descripcion_foto VARCHAR(400) NOT NULL, INDEX IDX_799760AA7521E135 (id_ruta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE foto_ruta ADD CONSTRAINT FK_799760AA7521E135 FOREIGN KEY (id_ruta_id) REFERENCES ruta (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE foto_ruta DROP FOREIGN KEY FK_799760AA7521E135
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE foto_ruta
        SQL);
    }
}
