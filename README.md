# TESTE DE BACK-END

## Descrição:
Usando as tecnologias de sua escolha (PHP/Ruby, framework é opcional), crie um mini blog com gerenciamento por um CMS:

- o CMS deve ser restrito. deve haver uma tabela com usuários e senhas para permitir a autenticação (não é necessário se preocupar com o gereciamento dos usuários)
- Não devem ser usadas funcionalidades para geração de código, como scaffold, etc.;
- Os posts e comentários devem ser persistidos no banco de dados de sua escolha (MySQL ou PostgreSQL);
- A home deve ter a listagem (com paginação) dos posts, mostrando título e os primeiros 100 caracteres do post;
- O título deve ter um link para a página de exibição;
- A página de exibição do post deve ter o título, o conteúdo completo do post, um formulário com os campos nome, email e texto (para submissão de comentários) e uma lista dos comentários que esse post possui;
- Na submissão de comentário, os campos "nome", "email" e "texto" não podem ser submetidos vazios; "email" deve ser um email válido e "texto" deve ter no mínimo 3 caracteres.
- Quesitos de segurança como sql injection, senhas em texto plano, filtro de input dos usuários etc devem ser observados;

## Orientações:
- Caso não tenha familiaridade com o `git`, você pode baixar e nos enviar um `zip` com o nome da pasta sendo `teste-seunome` por email `contato@yooh.com.br`;

## Recomendações:
* Comente o código, quando necessário, para explicar a intenção de trechos complexos;
* Não se preocupe com o frontend, mas monte o HTML "conscientemente";
* Inclua o dump do banco no projeto;
* Não se preocupe caso não consiga terminar o projeto no tempo. Nos envie como ele ficou mesmo que incompleto, a completude é importante mas não é o principal que será avaliado.

## Extra:
- Caso tenha conhecimento em `Git`, indicamos criar um fork do projeto e nos enviar para uma melhor avaliação;
