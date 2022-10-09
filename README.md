🕧 Attribute Reader
----------------

Reader to get attributes from a class, method or property.

----
### Installation

Run

```bash
composer require flexic/attribute-reader
```

to install `flexic/attribute-reader`.

----
### Get Attributes

```php
$reflectionClass = new \ReflectionClass(MyClass::class);

$attributeReader = new Flexic\Attributes\Reader();

$attributeReader->getAttributes($reflectionClass); // Returns list of given attributes
$attributeReader->getAttribute($reflectionClass, MyAttribute::class); // Returns first attribute of given type
```

----
### License
This package is licensed using the GNU License.

Please have a look at [LICENSE.md](LICENSE.md).

---

[![Donate](https://img.shields.io/badge/Donate-PayPal-blue.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=Q98R2QXXMTUF6&source=url)