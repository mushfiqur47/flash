## User Agent Library

  User Agent Library is parse data from user agent.

  - `ip` : get user ip address.
  - `os' : get user device os name.
  - `os_version` : get user device os version.
  - `browser` : get user browser name.
  - `browser_version` : get user browser version.
  - `device_type` : get user device type.
  - `device_brand` : get user device brand.

```php
class view extends Views {
  function home() {
    //get user data
    $data = array(
      'ip' => $this->user->ip,
      'os' => $this->user->os,
      'browser' => $this->user->browser,
    );
    return $this->response('home', $data);
  }
}
```
