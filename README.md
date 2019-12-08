<h3 align="center">PHP Rest API Client - Easy-to-Use</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

</div>

---

<p align="center"> PHP tool to connect to a REST API using design pattern Singleton and inheritance OOP.
    <br>
</p>

## 📝 Table of Contents

- [About](#about)
- [Getting Started](#getting_started)
- [Usage](#usage)
- [Built Using](#built_using)

## 🧐 About <a name = "about"></a>

<p>This PHP tool is tested and working just fine. It makes your life really easy to connect and process information to a REST API with no extra packages or libraries.</p>

<p>It was created as a coding exercise applying Inheritance OOP (Object-oriented programming) and design pattern Singleton. It uses CURL to handle all the processes.</p>

## 🏁 Getting Started <a name = "getting_started"></a>

To use it is very simple, you can either directly download the project or use composer. There are no external dependencies.

If you decide to use composer just type:

```shell
composer require bruno-canada/php-restclient-easytouse
```

### Prerequisites

```
PHP 5.5+
CURL mod enabled
```

## 🎈 Usage <a name="usage"></a>

Check the file "testing.php" as a real and working sample for you.

```shell
try {

    $getSales = EASYREST\APIClient::get($endpoint, $header, $parameters);
    print_r($getSales);

} catch (\Exception $e) {

    echo "Error: " . $e->getMessage();
}
```

## ⛏️ Built Using <a name = "built_using"></a>

- [PHP] (https://www.php.net/) PHP
- [CURL] (https://curl.haxx.se/) Transfering Data via CURL
