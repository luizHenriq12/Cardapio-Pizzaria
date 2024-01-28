# Cardápio Delivery

Um sistema de cardápio delivery desenvolvido em PHP, JavaScript, HTML e CSS para facilitar pedidos online.

## Visão Geral

O projeto tem como objetivo oferecer uma plataforma intuitiva para visualização de cardápios de restaurantes e realizar pedidos online. Os clientes podem explorar categorias de alimentos, visualizar detalhes dos produtos, adicionar itens ao carrinho e efetuar pedidos de forma simples e rápida.

## Funcionalidades

- **Visualização de Categorias:** Explore facilmente diferentes categorias de alimentos.
- **Detalhes do Produto:** Visualize informações detalhadas sobre cada produto, incluindo preço e descrição.
- **Carrinho de Compras:** Adicione itens ao carrinho de compras.
- **Resumo do Pedido:** Reveja os itens selecionados antes de finalizar o pedido.
- **Formulário de Pedido Online:** Preencha um formulário simples para realizar o pedido online.

## Tecnologias Utilizadas

- **Frontend:**
  - HTML
  - CSS
  - JavaScript

- **Backend:**
  - PHP

- **Banco de Dados:**
  - Utilize o banco de dados de sua escolha (exemplo: MySQL, PostgreSQL).

## Instalação

1. Clone o repositório: `git clone https://github.com/seu-usuario/nome-do-repositorio.git`
2. Configure o banco de dados com as informações necessárias (veja seção abaixo).
3. Inicie um servidor PHP: `php -S localhost:8000` (ou utilize um servidor web como Apache, Nginx, etc.).

## Configuração do Banco de Dados

1. Crie um banco de dados MySQL (ou outro de sua escolha).
2. Importe o script SQL fornecido (`script.sql`) para criar as tabelas necessárias.

Exemplo de script SQL para produtos:

```sql
CREATE TABLE produtos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255),
  descricao TEXT,
  preco DECIMAL(10, 2),
  categoria VARCHAR(50)
);
