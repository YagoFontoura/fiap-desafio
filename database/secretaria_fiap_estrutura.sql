CREATE DATABASE IF NOT EXISTS secretaria_fiap;
USE secretaria_fiap;

CREATE TABLE administradores (
    id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE alunos (
    id_aluno INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf CHAR(11) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE turmas (
    id_turma INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE matriculas (
    id_matricula INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT UNSIGNED NOT NULL,
    id_turma INT UNSIGNED NOT NULL,
    data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_aluno) REFERENCES alunos(id_aluno) ON DELETE CASCADE,
    FOREIGN KEY (id_turma) REFERENCES turmas(id_turma) ON DELETE CASCADE,
    UNIQUE KEY (id_aluno, id_turma)
) ENGINE=InnoDB;

-- Índices para administradores
CREATE INDEX idx_administradores_nome ON administradores(nome);
CREATE INDEX idx_administradores_created_at ON administradores(created_at);

-- Índices para alunos
CREATE INDEX idx_alunos_nome ON alunos(nome);
CREATE INDEX idx_alunos_data_nascimento ON alunos(data_nascimento);
CREATE INDEX idx_alunos_created_at ON alunos(created_at);
CREATE FULLTEXT INDEX idx_alunos_fulltext ON alunos(nome, email);

-- Índices para turmas
CREATE INDEX idx_turmas_nome ON turmas(nome);
CREATE INDEX idx_turmas_created_at ON turmas(created_at);
CREATE FULLTEXT INDEX idx_turmas_fulltext ON turmas(nome, descricao);

-- Índices para matriculas
CREATE INDEX idx_matriculas_id_aluno ON matriculas(id_aluno);
CREATE INDEX idx_matriculas_id_turma ON matriculas(id_turma);
CREATE INDEX idx_matriculas_data_matricula ON matriculas(data_matricula);
CREATE INDEX idx_matriculas_aluno_data ON matriculas(id_aluno, data_matricula);
CREATE INDEX idx_matriculas_turma_data ON matriculas(id_turma, data_matricula);

-- Inserir administrador padrão
INSERT INTO administradores (nome, email, senha)
VALUES ('Administrador', 'admin@fiap.com.br', '$2a$12$gFoTbDwoyy5oocIBgBU22u3fZ6PQlZ5nDrHFKkUGeDqaAeh3IGO8y');