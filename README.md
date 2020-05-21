<p align="center"><img src="https://camo.githubusercontent.com/27d69461ad4caeb670264814c1fb624faadc9dca/68747470733a2f2f61646d696e6c74652e696f2f41646d696e4c5445332e706e67"></p>



## Projeto de Adminsitração de Material
Este projeto tem por finalidade criar um ambiente para administração de material:

- Integração com o AdminLTE
- Sistema de ACL
- Administração de Setores
    
## Instlalando o projeto Laravel
* digite o comando: composer require laravel/ui
* digite o comando: php artisan ui vue --auth
* digite o comando: composer require jotaelesalinas/laravel-adminless-ldap-auth
## Importante: O uso deste pacote de autenticação é muito específico: Este pacote faz apenas uma coisa: validar as credenciais dos usuários em um servidor LDAP. Não é possível criar / modificar / excluir usuários no aplicativo Laravel. O gerenciamento de usuários é feito no servidor LDAP.
* digite o comando: laravel new nome_do_projeto --auth
* digite o comando: composer install

## Ou caso não tenha instalado o --auth Instalando autenticação para o laravel
O ideal é fazer a instalação do projeto já com a autenticação, caso não faça, realizar esse procedimento:
* digite o comando: composer require laravel/ui
* digite o comando: composer require jotaelesalinas/laravel-adminless-ldap-auth
## Importante: O uso deste pacote de autenticação é muito específico: Este pacote faz apenas uma coisa: validar as credenciais dos usuários em um servidor LDAP. Não é possível criar / modificar / excluir usuários no aplicativo Laravel. O gerenciamento de usuários é feito no servidor LDAP.
* digite o comando: php artisan ui vue --auth
* digite o comando: npm install
* digite o comando: npm run dev
* digite o comando: php artisan key:generate

## Subindo Arquivos para o GitHub
* primeiro abra o github
* faça login com a conta conta de email cadastrada no github
* no botão lateral superior direito, escolha a opção your repositories
* no botão verde direito, clique na opção clone or download
* copie o endereço
* no terminal do VSCODE  para iniciar o git ou outro editor de texto de sua escolha, digite o comando: git init 
* digite o comando: git remote add origin https://github.com/edinardo-gurgel-linhares/projetoadminlte.git
* digite o comando: git status (para ver as pastas do projeto)
* digite o comando: git add . (para adicionar o projeto, inclusive o espaço e ponto)
* digite o comando: git commit -m "Adicionando Autenticação"
* digite o comando: git push --force origin master

## Configurando o Módulo LDAP
* Uma observação sobre as variáveis .env mais importantes LDAP_USER_SEARCH_ATTRIBUTE: o nome do atributo no servidor LDAP que identifica exclusivamente um usuário, por exemplo, uid, mail ou sAMAccountName. O valor desse atributo é o que o usuário precisará digitar como identificador no formulário de login (+ a senha, é claro). 
* LDAP_USER_BIND_ATTRIBUTE: o nome do atributo no servidor LDAP usado dentro do nome distinto, por exemplo uid ou cn. O valor será lido dos atributos do usuário retornados pelo servidor LDAP. 
*AUTH_USER_KEY_FIELD: o nome da propriedade que identificará exclusivamente o usuário Auth. Por padrão, o nome é nome de usuário e o valor é lido no atributo do usuário LDAP LDAP_USER_SEARCH_ATTRIBUTE.

Veja uma explicação de como a biblioteca funciona para uma melhor compreensão da lógica por trás das diferentes variáveis. Adicionar variáveis ao .env Você precisará da assistência do administrador do LDAP para acertar essas opções.

LDAP_SCHEMA=OpenLDAP                    # Tem que ser um destes:
                                        # - OpenLDAP
                                        # - FreeIPA
                                        # - ActiveDirectory
LDAP_HOSTS=ldap.forumsys.com            # Seu servidor LDAP
LDAP_BASE_DN=dc=example,dc=com          # nome distinto base
LDAP_USER_SEARCH_ATTRIBUTE=uid          # campo pelo qual seus usuários são identificados no servidor LDAP
LDAP_USER_BIND_ATTRIBUTE=uid            # campo pelo qual seus usuários estão ligados ao servidor LDAP
LDAP_USER_FULL_DN_FMT=${LDAP_USER_BIND_ATTRIBUTE}=%s,${LDAP_BASE_DN}
                                        # nome distinto do usuário completo a ser usado com o sprintf:
                                        #% s será substituído por $ user -> $ {LDAP_USER_BIND_ATTRIBUTE}
LDAP_CONNECTION=default                 # que configuração usar em config / ldap.php

Estas são apenas algumas opções, necessárias para fazer este exemplo funcionar. Existem muitos outros em config/ldap.php.

Para usuários do ActiveDirectory

Essa configuração pode funcionar para você (não posso prometer que funcionará):

LDAP_SCHEMA=ActiveDirectory
LDAP_USER_SEARCH_ATTRIBUTE=sAMAccountName
LDAP_USER_BIND_ATTRIBUTE=cn

Além disso, adicione o nome da propriedade que identificará exclusivamente o usuário do autenticado:

AUTH_USER_KEY_FIELD=username

Você pode alterar o valor de AUTH_USER_KEY_FIELD para o que quiser, por exemplo ID, email ou número de telefone, mas você realmente não precisa.

Modifique config/auth.php Adicione um novo provedor LDAP usando o driver adminless_ldap recém-instalado:

'providers' => [
    'ldap' => [
        'driver' => 'adminless_ldap',
    ],
],

Você pode excluir o provedor de usuários, se desejar. Ou apenas comente. Não deixe o código não utilizado por aí. Modifique o web guard para usar o novo provedor ldap:

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'ldap',
    ],
],

Exclua a proteção da API, se você não precisar. Ou pelo menos comente. 

Crie esta nova entrada:
'auth_user_key' => env('AUTH_USER_KEY_FIELD', null),

Publique os arquivos de configuração do Adldap e AdldapAuth
php artisan vendor:publish --provider="Adldap\Laravel\AdldapServiceProvider"
php artisan vendor:publish --provider="Adldap\Laravel\AdldapAuthServiceProvider"

Configure a conexão LDAP em config/ldap.php Novamente, você precisará da assistência do seu administrador LDAP. 
Veja os comentários abaixo.

'connections' => [
    // aqui, em teoria, devemos deixar o `default` intocado e criar uma nova conexão 
    // (e alterar o LDAP_CONNECTION` no` .env` de acordo) 
    // mas não consegui fazer o pacote Adldap subjacente funcionar com qualquer conexão 
    // diferente de `default ', então modificaremos a conexão padrão diretamente
 'default' => [
        'auto_connect' => env('LDAP_AUTO_CONNECT', false),

        'connection' => Adldap\Connections\Ldap::class,

        'settings' => [
            // substitua esta linha:             
            // 'schema' => Adldap \ Schemas \ ActiveDirectory :: class,             
            // com isso:
            'schema' => env('LDAP_SCHEMA', '') == 'OpenLDAP' ?
                Adldap\Schemas\OpenLDAP::class :
                ( env('LDAP_SCHEMA', '') == 'FreeIPA' ?
                    Adldap\Schemas\FreeIPA::class :
                    Adldap\Schemas\ActiveDirectory::class ),
            // remova os valores padrão dessas opções:
                        'hosts' => explode(' ', env('LDAP_HOSTS', '')),
            'base_dn' => env('LDAP_BASE_DN', ''),
            'username' => env('LDAP_ADMIN_USERNAME', ''),
            'password' => env('LDAP_ADMIN_PASSWORD', ''),

            // e converse com seu administrador LDAP sobre essas outras opções.
            // não modifique-os aqui, use .env!
            'account_prefix' => env('LDAP_ACCOUNT_PREFIX', ''),
            'account_suffix' => env('LDAP_ACCOUNT_SUFFIX', ''),
            'port' => env('LDAP_PORT', 389),
            'timeout' => env('LDAP_TIMEOUT', 5),
            'follow_referrals' => env('LDAP_FOLLOW_REFERRALS', false),
            'use_ssl' => env('LDAP_USE_SSL', false),
            'use_tls' => env('LDAP_USE_TLS', false),

        ],
    ],
],

Configure a autenticação LDAP em config/ldap_auth.php 
Diga à biblioteca do Adldap como procurar e vincular usuários no seu servidor LDAP:
'identifiers' => [
    // ... seu código ...

    'ldap' => [
        'locate_users_by' => env('LDAP_USER_SEARCH_ATTRIBUTE', ''),
        'bind_users_by' => env('LDAP_USER_BIND_ATTRIBUTE', ''),
        'user_format' => env('LDAP_USER_FULL_DN_FMT', ''),
    ],

    // ... seu código ...
],

E informe ao novo provedor de autenticação quais campos da entrada do usuário LDAP você deseja "importar" para o seu usuário Auth em cada login bem-sucedido.
Então é isso aí! Agora você deve poder usar a autenticação integrada do Laravel para executar todas as tarefas relacionadas à autenticação, por exemplo, Auth::check(), Auth::attempt(), Auth::user(), etc.

Você pode tentar com o Tinker:

Auth::guest()
=> true
Auth::check()
=> false
Auth::user()
=> null
Auth::id()
=> null

Auth::attempt(['username' => 'einstein', 'password' => ''])
// Inclua Adldap/Auth/PasswordRequiredException.

Auth::attempt(['username' => 'einstein', 'password' => 'qwerty'])
// O Tinker emite um aviso sobre ldap_bind () incapaz de vincular ao servidor e credenciais inválidas.
=> false

Auth::attempt(['username' => 'einstein', 'password' => 'password'])
//Nesse caso ele emitirá um aviso sobre o armazenamento da sessão. Ignore isso
.
=> true

Auth::guest()
=> false
Auth::check()
=> true
Auth::user()
=> JotaEleSalinas\AdminlessLdap\LdapUser {
     username: "einstein",
     name: "Albert Einstein",
     email: "einstein@ldap.forumsys.com",
     phone: "314-159-2653",
   }
Auth::id()
=> "einstein"

Auth::logout()
=> null
Auth::check()
=> false
Auth::user()
=> null

Lembre-se de que você tem esses usuários disponíveis no servidor LDAP de teste público: einstein, newton e tesla. A senha é a password para todos eles.

Interface do usuário de logon (rotas, controladores, visualizações)
Se você deseja ver como criar uma interface de usuário de login adaptada a esse sistema LDAP específico sem administrador, pode ler o guia de UI de login.

Façam
  Testes - WIP
  Instruções para o ActiveDirectory - é necessária a ajuda, não tenho acesso a nenhum servidor AD
  Temos que acionar eventos para tentativas de login, sucesso, falha, logout, etc? Ou eles são acionados em outro lugar?
  Adicione instruções para criar a interface do usuário de login
  Estenda LdapUser em Illuminate \ Auth \ GenericUser
  Carregar no packagist
  Configure o gancho GitHub para Packagist para automatizar novas versões

Fonte: https://github.com/jotaelesalinas/laravel-adminless-ldap-auth

Créditos
José Luis Salinas
Todos os colaboradores
Meus sinceros agradecimentos

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
#   p r o j e t o a d m i n l t e 
 
 