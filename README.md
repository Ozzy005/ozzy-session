## **Ozzy Session**

- Um simples gerenciador de sessão php com suporte a tree array.

### **Ambiente Necessário**

- PHP (>= 8.1)

### **Uso**

No arquivo de configuração, pode-se definir o tempo de vida da sessão e de quanto em quanto tempo o ID de sessão deve ser regenerado.
Através das constantes `SESSION_LIFETIME` e `REGENERATE_SESSION`.
Um menor tempo de `REGENERATE_SESSION` significa uma maior segurança.

```php
define('SESSION_LIFETIME', 1440); //EM SEGUNDOS
define('REGENERATE_SESSION', 60); //EM SEGUNDOS
```

Continuando no arquivo de configuração; está definido algumas diretivas pra uma maior segurança, mas você pode removê-las ou editá-las como quiser. Para saber do que se trata cada diretiva, indico a leitura [Protegendo as configurações INI relacionadas à sessão](https://www.php.net/manual/pt_BR/session.security.ini.php).

```php
ini_set('session.cache_expire', 60);
ini_set('session.cache_limiter', 'nocache');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_lifetime', 0);
ini_set('session.cookie_secure', 0);
ini_set('session.gc_divisor', 1000);
ini_set('session.gc_maxlifetime', 1440);
ini_set('session.gc_probability', 0);
ini_set('session.lazy_write', 1);
ini_set('session.name', 'ozzy-session');
ini_set('session.referer_check', '');
ini_set('session.serialize_handler', 'php_serialize');
ini_set('session.sid_bits_per_character', 5);
ini_set('session.sid_length', 32);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_trans_sid', 0);
```

Iniciando a sessão.
```php
require_once __DIR__ . '/Src/config.php';
require_once __DIR__ . '/vendor/autoload.php';

use Src\Session;

new Session();
```

Salvando alguma coisa na sessão com o método `put` (esse método substitui qualquer valor existente).
```php

Session::put('numero', 1);

var_dump($_SESSION);

/*
array (size=1)
  'numero' => int 1
*/

//também é possível fazer algo assim por causa do tree array
Session::put('times.devs.1', 'faluno');

var_dump($_SESSION);

/* 
array (size=2)
  'numero' => int 1
  'times' => 
    array (size=1)
      'devs' => 
        array (size=1)
          1 => string 'faluno' (length=6)
*/

```

Verificando se tem algum valor na sessão com o método `has` (retorna `false` caso a variável não exista ou esteja `null`)
```php
Session::put('times.devs.1', 'faluno');

//true
var_dump(Session::has('times.devs.1'));

//false
var_dump(Session::has('times.devs.2'));

Session::put('times.devs.3', null);

//false
var_dump(Session::has('times.devs.3'));
```

Verificando se um valor existe na sessão mesmo que seja `null` com o método `exists`.
```php
Session::put('times.devs.3', null);

//true
var_dump(Session::exists('times.devs.3'));
```

Verificando se um valor está ausente com o método `missing` (esse método retorna `true` se a variável não existir ou for `null`).
```php
Session::put('times.devs.1', null);

//true
var_dump(Session::missing('times.devs.1'));

//true
var_dump(Session::missing('times.devs.2'));

Session::put('times.devs.2', true);

//false
var_dump(Session::missing('times.devs.2'));
```

Pegado um valor com o método `get` (retorna `null` se não existir).
```php
Session::put('times.devs.1', 'algumaCoisa');

var_dump(Session::get('times.devs.1'));

/* 
string 'algumaCoisa' (length=11)
*/
```

Adicionando um valor no final de um array com o método `push`.
```php
Session::put('times.devs.1', 'item1');

var_dump($_SESSION);

/* 
array (size=1)
  'times' => 
    array (size=1)
      'devs' => 
        array (size=1)
          1 => string 'item1' (length=5)
*/

Session::push('times.devs.2', 'item2');

var_dump($_SESSION);

/* 
array (size=1)
  'times' => 
    array (size=1)
      'devs' => 
        array (size=2)
          1 => string 'item1' (length=5)
          2 => string 'item2' (length=5)
*/
```

Removendo um valor com o método `forget`.
```php
Session::put('numero', 1);

var_dump($_SESSION);

/* 
array (size=1)
  'numero' => int 1
*/

Session::forget('numero');

var_dump($_SESSION);

/* 
array (size=0)
  empty
*/
```

E para destruir completamente a sessão , basta utilizar o método `destroy`.
Importante que a diretiva `session.use_strict_mode` esteja habilitada.
```php
Session::destroy();
```

### **Licença**

- Este projeto está sob a licença (MIT) - veja o arquivo - [LICENSE.md](https://github.com/Ozzy005/ozzy-session/blob/main/LICENSE) para detalhes.

### **Autores**

- [Rafael Arend](https://github.com/Ozzy005)

### **Email**

- rafinhaarend123@hotmail.com
