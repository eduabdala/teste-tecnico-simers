<?php

require_once __DIR__ . '/../app/models/User.php';

$userModel = new User();

//
// 🔹 TESTES DE CRIAÇÃO COM VÁRIOS USUÁRIOS
//

try {
    echo "🔹 Teste 1: Criando usuário com e-mail inválido...\n";
    $userModel->create([
        'nome' => 'Usuário Inválido',
        'cpf' => '000.000.000-00',
        'email' => 'emailinvalido.com',
        'data_nascimento' => '1999-12-31',
        'telefone' => '(51)90000-0000',
        'senha' => 'senha123'
    ]);
} catch (Exception $e) {
    echo "❌ Erro esperado: " . $e->getMessage() . "\n\n";
}

try {
    echo "🔹 Teste 2: Criando usuário com senha vazia...\n";
    $userModel->create([
        'nome' => 'Sem Senha',
        'cpf' => '000.000.000-01',
        'email' => 'sem_senha@example.com',
        'data_nascimento' => '1995-10-10',
        'telefone' => '(51)91111-1111',
        'senha' => ''
    ]);
} catch (Exception $e) {
    echo "❌ Erro esperado: " . $e->getMessage() . "\n\n";
}

try {
    echo "🔹 Teste 3: Criando usuário válido...\n";
    $userModel->create([
        'nome' => 'Maria Teste',
        'cpf' => '000.000.000-02',
        'email' => 'maria@example.com',
        'data_nascimento' => '1985-07-20',
        'telefone' => '(51)92222-2222',
        'senha' => 'senhaForte123'
    ]);
    echo "✅ Usuário criado com sucesso.\n\n";
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n\n";
}

try {
    echo "🔹 Teste 4: Criando outro usuário válido...\n";
    $userModel->create([
        'nome' => 'José Silva',
        'cpf' => '000.000.000-03',
        'email' => 'jose@example.com',
        'data_nascimento' => '1992-01-15',
        'telefone' => '(51)93333-3333',
        'senha' => 'senhaSegura456'
    ]);
    echo "✅ Usuário criado com sucesso.\n\n";
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n\n";
}

//
// 🔹 TESTE DE E-MAIL DUPLICADO
//

try {
    echo "🔹 Teste 5: Tentando criar usuário com e-mail duplicado...\n";
    $userModel->create([
        'nome' => 'Carlos Duplicado',
        'cpf' => '000.000.000-04',
        'email' => 'maria@example.com', // Email já utilizado
        'data_nascimento' => '1988-09-25',
        'telefone' => '(51)94444-4444',
        'senha' => 'senhaNova123'
    ]);
} catch (Exception $e) {
    echo "❌ Erro esperado: " . $e->getMessage() . "\n\n";
}

//
// 🔹 TESTE DE LISTAGEM
//

try {
    echo "🔹 Teste 6: Listando todos os usuários...\n";
    $usuarios = $userModel->getAll();
    print_r($usuarios);
    echo "\n";
} catch (Exception $e) {
    echo "❌ Erro ao listar usuários: " . $e->getMessage() . "\n\n";
}

//
// 🔹 TESTE DE BUSCA POR ID
//

try {
    echo "🔹 Teste 7: Buscando usuário com ID 999 (inexistente)...\n";
    $usuario = $userModel->findById(999);
    print_r($usuario ?: "Nenhum usuário encontrado com ID 999.\n");
    echo "\n";
} catch (Exception $e) {
    echo "❌ Erro ao buscar usuário: " . $e->getMessage() . "\n\n";
}

try {
    echo "🔹 Teste 8: Buscando usuário com ID 1 (existe)...\n";
    $usuario = $userModel->findById(1); // Supondo que ID 1 seja válido
    print_r($usuario);
    echo "\n";
} catch (Exception $e) {
    echo "❌ Erro ao buscar usuário: " . $e->getMessage() . "\n\n";
}

//
// 🔹 TESTE DE ATUALIZAÇÃO
//

try {
    echo "🔹 Teste 9: Atualizando usuário existente com dados válidos...\n";
    $userModel->update(2, [
        'nome' => 'João Atualizado',
        'cpf' => '000.000.000-02',
        'email' => 'joaoatualizado@example.com',
        'data_nascimento' => '1990-05-15',
        'telefone' => '(51)97777-7777',
        'senha' => 'senhaNovaSegura'
    ]);
    echo "✅ Usuário atualizado com sucesso.\n\n";
} catch (Exception $e) {
    echo "❌ Erro ao atualizar usuário: " . $e->getMessage() . "\n\n";
}

try {
    echo "🔹 Teste 10: Atualizando usuário com ID inexistente...\n";
    $userModel->update(999, [ // ID 999 não existe
        'nome' => 'Usuário Inexistente',
        'cpf' => '111.111.111-11',
        'email' => 'inexistente@example.com',
        'data_nascimento' => '2000-01-01',
        'telefone' => '(51)98888-8888',
        'senha' => 'senhaInexistente'
    ]);
} catch (Exception $e) {
    echo "❌ Erro esperado: " . $e->getMessage() . "\n\n";
}

//
// 🔹 TESTE DE EXCLUSÃO
//

try {
    echo "🔹 Teste 11: Excluindo usuário com ID 2...\n";
    $userModel->delete(2);
    echo "✅ Usuário excluído com sucesso.\n\n";
} catch (Exception $e) {
    echo "❌ Erro ao excluir usuário: " . $e->getMessage() . "\n\n";
}

try {
    echo "🔹 Teste 12: Tentando excluir usuário com ID inexistente...\n";
    $userModel->delete(999); // ID inexistente
} catch (Exception $e) {
    echo "❌ Erro esperado ao tentar excluir usuário: " . $e->getMessage() . "\n\n";
}

//
// 🔹 TESTE DE ATUALIZAÇÃO DE SENHA
//

try {
    echo "🔹 Teste 13: Atualizando senha de usuário existente...\n";
    $userModel->update(1, [ // ID 1, por exemplo, existe
        'senha' => 'novaSenhaForte123'
    ]);
    echo "✅ Senha atualizada com sucesso.\n\n";
} catch (Exception $e) {
    echo "❌ Erro ao atualizar senha: " . $e->getMessage() . "\n\n";
}
