<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>WiFiCom Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
                    body .content .php-example code { display: none; }
                    body .content .python-example code { display: none; }
            </style>

    <script>
        var baseUrl = "https://digiunlocker-wificom-filament.test";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-4.16.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-4.16.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;,&quot;python&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                            <button type="button" class="lang-button" data-language-name="php">php</button>
                                            <button type="button" class="lang-button" data-language-name="python">python</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-application-send_digirom">
                                <a href="#endpoints-POSTapi-v1-application-send_digirom">POST api/v1/application/send_digirom</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-application-last_output">
                                <a href="#endpoints-POSTapi-v1-application-last_output">POST api/v1/application/last_output</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: March 15, 2023</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>WiFiCom application APIphp artisan scribe:generate</p>
<aside>
    <strong>Base URL</strong>: <code>https://digiunlocker-wificom-filament.test</code>
</aside>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {USER_API_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your settings and clicking <b>Generate API token</b> at the bottom of the page.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-v1-application-send_digirom">POST api/v1/application/send_digirom</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-application-send_digirom">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://digiunlocker-wificom-filament.test/api/v1/application/send_digirom" \
    --header "Authorization: Bearer {USER_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"device_uuid\": \"lflvmcrhmydnrdrd\",
    \"application_uuid\": \"oalrxnubwlviufen\",
    \"comment\": \"otzpshhhzjcfqki\",
    \"digirom\": \"illum\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://digiunlocker-wificom-filament.test/api/v1/application/send_digirom"
);

const headers = {
    "Authorization": "Bearer {USER_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "device_uuid": "lflvmcrhmydnrdrd",
    "application_uuid": "oalrxnubwlviufen",
    "comment": "otzpshhhzjcfqki",
    "digirom": "illum"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://digiunlocker-wificom-filament.test/api/v1/application/send_digirom',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {USER_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'device_uuid' =&gt; 'lflvmcrhmydnrdrd',
            'application_uuid' =&gt; 'oalrxnubwlviufen',
            'comment' =&gt; 'otzpshhhzjcfqki',
            'digirom' =&gt; 'illum',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://digiunlocker-wificom-filament.test/api/v1/application/send_digirom'
payload = {
    "device_uuid": "lflvmcrhmydnrdrd",
    "application_uuid": "oalrxnubwlviufen",
    "comment": "otzpshhhzjcfqki",
    "digirom": "illum"
}
headers = {
  'Authorization': 'Bearer {USER_API_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-application-send_digirom">
</span>
<span id="execution-results-POSTapi-v1-application-send_digirom" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-application-send_digirom"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-application-send_digirom" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-application-send_digirom" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-application-send_digirom"></code></pre>
</span>
<form id="form-POSTapi-v1-application-send_digirom" data-method="POST"
      data-path="api/v1/application/send_digirom"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-application-send_digirom', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-application-send_digirom"
                    onclick="tryItOut('POSTapi-v1-application-send_digirom');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-application-send_digirom"
                    onclick="cancelTryOut('POSTapi-v1-application-send_digirom');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-application-send_digirom" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/application/send_digirom</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-application-send_digirom"
               value="Bearer {USER_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {USER_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="Content-Type"                data-endpoint="POSTapi-v1-application-send_digirom"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="Accept"                data-endpoint="POSTapi-v1-application-send_digirom"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>device_uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="device_uuid"                data-endpoint="POSTapi-v1-application-send_digirom"
               value="lflvmcrhmydnrdrd"
               data-component="body">
    <br>
<p>Must be 16 characters. Example: <code>lflvmcrhmydnrdrd</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>application_uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="application_uuid"                data-endpoint="POSTapi-v1-application-send_digirom"
               value="oalrxnubwlviufen"
               data-component="body">
    <br>
<p>Must be 16 characters. Example: <code>oalrxnubwlviufen</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
               name="comment"                data-endpoint="POSTapi-v1-application-send_digirom"
               value="otzpshhhzjcfqki"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>otzpshhhzjcfqki</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>digirom</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="digirom"                data-endpoint="POSTapi-v1-application-send_digirom"
               value="illum"
               data-component="body">
    <br>
<p>Example: <code>illum</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-application-last_output">POST api/v1/application/last_output</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-application-last_output">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://digiunlocker-wificom-filament.test/api/v1/application/last_output" \
    --header "Authorization: Bearer {USER_API_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"application_uuid\": \"gxpbhlxjkxfjcxxu\",
    \"device_uuid\": \"nzgyvfytyvnymfjl\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://digiunlocker-wificom-filament.test/api/v1/application/last_output"
);

const headers = {
    "Authorization": "Bearer {USER_API_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "application_uuid": "gxpbhlxjkxfjcxxu",
    "device_uuid": "nzgyvfytyvnymfjl"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'https://digiunlocker-wificom-filament.test/api/v1/application/last_output',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {USER_API_TOKEN}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'application_uuid' =&gt; 'gxpbhlxjkxfjcxxu',
            'device_uuid' =&gt; 'nzgyvfytyvnymfjl',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>


<div class="python-example">
    <pre><code class="language-python">import requests
import json

url = 'https://digiunlocker-wificom-filament.test/api/v1/application/last_output'
payload = {
    "application_uuid": "gxpbhlxjkxfjcxxu",
    "device_uuid": "nzgyvfytyvnymfjl"
}
headers = {
  'Authorization': 'Bearer {USER_API_TOKEN}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-application-last_output">
</span>
<span id="execution-results-POSTapi-v1-application-last_output" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-application-last_output"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-application-last_output" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-application-last_output" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-application-last_output"></code></pre>
</span>
<form id="form-POSTapi-v1-application-last_output" data-method="POST"
      data-path="api/v1/application/last_output"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-application-last_output', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-application-last_output"
                    onclick="tryItOut('POSTapi-v1-application-last_output');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-application-last_output"
                    onclick="cancelTryOut('POSTapi-v1-application-last_output');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-application-last_output" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/application/last_output</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-application-last_output"
               value="Bearer {USER_API_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {USER_API_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="Content-Type"                data-endpoint="POSTapi-v1-application-last_output"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="Accept"                data-endpoint="POSTapi-v1-application-last_output"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>application_uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="application_uuid"                data-endpoint="POSTapi-v1-application-last_output"
               value="gxpbhlxjkxfjcxxu"
               data-component="body">
    <br>
<p>Must be 16 characters. Example: <code>gxpbhlxjkxfjcxxu</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>device_uuid</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
               name="device_uuid"                data-endpoint="POSTapi-v1-application-last_output"
               value="nzgyvfytyvnymfjl"
               data-component="body">
    <br>
<p>Must be 16 characters. Example: <code>nzgyvfytyvnymfjl</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                                        <button type="button" class="lang-button" data-language-name="php">php</button>
                                                        <button type="button" class="lang-button" data-language-name="python">python</button>
                            </div>
            </div>
</div>
</body>
</html>
