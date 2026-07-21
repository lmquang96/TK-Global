<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>TK-Global API Documentation</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('/vendor/scribe/css/theme-default.style.css') }}" media="screen">
  <link rel="stylesheet" href="{{ asset('/vendor/scribe/css/theme-default.print.css') }}" media="print">

  <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
  <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

  <style id="language-style">
    /* starts out as display none and is replaced with js later  */
    body .content .bash-example code {
      display: none;
    }

    body .content .javascript-example code {
      display: none;
    }

    body .content .php-example code {
      display: none;
    }

    body .content .python-example code {
      display: none;
    }
  </style>

  <script>
    var tryItOutBaseUrl = "http://localhost:8000";
    var useCsrf = Boolean();
    var csrfUrl = "/sanctum/csrf-cookie";
  </script>
  <script src="{{ asset('/vendor/scribe/js/tryitout-5.11.0.js') }}"></script>

  <script src="{{ asset('/vendor/scribe/js/theme-default-5.11.0.js') }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;,&quot;python&quot;]">

  <a href="#" id="nav-button">
    <span>
      MENU
      <img src="{{ asset('/vendor/scribe/images/navbar.png') }}" alt="navbar-image" />
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
          <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-token">
            <a href="#endpoints-POSTapi-v1-token">Get Access Token</a>
          </li>
          <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-conversions">
            <a href="#endpoints-GETapi-v1-conversions">Get Conversions</a>
          </li>
        </ul>
      </ul>
    </div>

    <ul class="toc-footer" id="toc-footer">
      <li style="padding-bottom: 5px;"><a href="{{ route('scribe.postman') }}">View Postman collection</a></li>
      <li style="padding-bottom: 5px;"><a href="{{ route('scribe.openapi') }}">View OpenAPI spec</a></li>
      {{-- <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li> --}}
    </ul>

    <ul class="toc-footer" id="last-updated">
      <li>Last updated: July 13, 2026</li>
    </ul>
  </div>

  <div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
      <h1 id="introduction">Introduction</h1>
      <aside>
        <strong>Base URL</strong>: <code>https://pub.tkglobal.asia/</code>
      </aside>

      <h1 id="authenticating-requests">Authenticating requests</h1>
      <p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value
        <strong><code>"Bearer {your_access_token}"</code></strong>.
      </p>
      <p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation
        below.</p>
      <p>Please obtain the token from the API /api/v1/token.</p>

      <h1 id="endpoints">Endpoints</h1>



      <h2 id="endpoints-POSTapi-v1-token">Get Access Token</h2>

      <p>
      </p>

      <p>This API exchanges an API Key and API Secret for a short-lived Access Token.
        ⚠️ Note: This API is publicly accessible and does NOT require a Bearer Token in the header.</p>

      <span id="example-requests-POSTapi-v1-token">
        <blockquote>Example request:</blockquote>


        <div class="bash-example">
          <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/token" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"api_key\": \"rET8aqQRN5dThpXU4APiXz2U\",
    \"api_secret\": \"eHldNmoEngCOIxmc8oE4s3D8CXkGQI2Bqo8AzccGwnTd8d0u\"
}"
</code></pre>
        </div>


        <div class="javascript-example">
          <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/token"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "api_key": "rET8aqQRN5dThpXU4APiXz2U",
    "api_secret": "eHldNmoEngCOIxmc8oE4s3D8CXkGQI2Bqo8AzccGwnTd8d0u"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
        </div>


        <div class="php-example">
          <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/token';
$response = $client-&gt;post(
    $url,
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'api_key' =&gt; 'rET8aqQRN5dThpXU4APiXz2U',
            'api_secret' =&gt; 'eHldNmoEngCOIxmc8oE4s3D8CXkGQI2Bqo8AzccGwnTd8d0u',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
        </div>


        <div class="python-example">
          <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/token'
payload = {
    "api_key": "rET8aqQRN5dThpXU4APiXz2U",
    "api_secret": "eHldNmoEngCOIxmc8oE4s3D8CXkGQI2Bqo8AzccGwnTd8d0u"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
        </div>

      </span>

      <span id="example-responses-POSTapi-v1-token">
        <blockquote>
          <p>Example response (200):</p>
        </blockquote>
        <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;accesss_token&quot;: &quot;dPllco1OWOUdc5oNl3OcpZ9OkahCPrQfLqjD7r8TRzFMCkXdG4nqIWrtibGd&quot;,
        &quot;expires_in&quot;: &quot;2026-07-10T15:40:54.838314Z&quot;
    }
}</code>
 </pre>
      </span>
      <span id="execution-results-POSTapi-v1-token" hidden>
        <blockquote>Received response<span id="execution-response-status-POSTapi-v1-token"></span>:
        </blockquote>
        <pre class="json"><code id="execution-response-content-POSTapi-v1-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
      </span>
      <span id="execution-error-POSTapi-v1-token" hidden>
        <blockquote>Request failed with error:</blockquote>
        <pre><code id="execution-error-message-POSTapi-v1-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
      </span>
      <form id="form-POSTapi-v1-token" data-method="POST" data-path="api/v1/token" data-authed="0"
        data-hasfiles="0" data-isarraybody="0" autocomplete="off"
        onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-token', this);">
        <h3>
          Request&nbsp;&nbsp;&nbsp;
          <button type="button"
            style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
            id="btn-tryout-POSTapi-v1-token" onclick="tryItOut('POSTapi-v1-token');">Try it out ⚡
          </button>
          <button type="button"
            style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
            id="btn-canceltryout-POSTapi-v1-token" onclick="cancelTryOut('POSTapi-v1-token');" hidden>Cancel 🛑
          </button>&nbsp;&nbsp;
          <button type="submit"
            style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
            id="btn-executetryout-POSTapi-v1-token" data-initial-text="Send Request 💥"
            data-loading-text="⏱ Sending..." hidden>Send Request 💥
          </button>
        </h3>
        <p>
          <small class="badge badge-black">POST</small>
          <b><code>api/v1/token</code></b>
        </p>
        <h4 class="fancy-heading-panel"><b>Headers</b></h4>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="Content-Type" data-endpoint="POSTapi-v1-token"
            value="application/json" data-component="header">
          <br>
          <p>Example: <code>application/json</code></p>
        </div>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="Accept" data-endpoint="POSTapi-v1-token"
            value="application/json" data-component="header">
          <br>
          <p>Example: <code>application/json</code></p>
        </div>
        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
          <b style="line-height: 2;"><code>api_key</code></b>&nbsp;&nbsp;
          <small>string</small>&nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="api_key" data-endpoint="POSTapi-v1-token"
            value="rET8aqQRN5dThpXU4APiXz2U" data-component="body">
          <br>
          <p>Your API key. Example: <code>rET8aqQRN5dThpXU4APiXz2U</code></p>
        </div>
        <div style=" padding-left: 28px;  clear: unset;">
          <b style="line-height: 2;"><code>api_secret</code></b>&nbsp;&nbsp;
          <small>string</small>&nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="api_secret" data-endpoint="POSTapi-v1-token"
            value="eHldNmoEngCOIxmc8oE4s3D8CXkGQI2Bqo8AzccGwnTd8d0u" data-component="body">
          <br>
          <p>Your API secret. Example: <code>eHldNmoEngCOIxmc8oE4s3D8CXkGQI2Bqo8AzccGwnTd8d0u</code></p>
        </div>
      </form>

      <h2 id="endpoints-GETapi-v1-conversions">Get Conversions</h2>

      <p>
        <small class="badge badge-darkred">requires authentication</small>
      </p>

      <p>This API exchanges an API Key and API Secret for a short-lived Access Token.
        ⚠️ Note: This API is publicly accessible and does NOT require a Bearer Token in the header.</p>

      <span id="example-requests-GETapi-v1-conversions">
        <blockquote>Example request:</blockquote>


        <div class="bash-example">
          <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/conversions?from_date=2026-01-01&amp;to_date=2026-06-30&amp;page=1&amp;limit=25" \
    --header "Authorization: Bearer {your_access_token}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
        </div>


        <div class="javascript-example">
          <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/conversions"
);

const params = {
    "from_date": "2026-01-01",
    "to_date": "2026-06-30",
    "page": "1",
    "limit": "25",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {your_access_token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
        </div>


        <div class="php-example">
          <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$url = 'http://localhost:8000/api/v1/conversions';
$response = $client-&gt;get(
    $url,
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {your_access_token}',
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'from_date' =&gt; '2026-01-01',
            'to_date' =&gt; '2026-06-30',
            'page' =&gt; '1',
            'limit' =&gt; '25',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
        </div>


        <div class="python-example">
          <pre><code class="language-python">import requests
import json

url = 'http://localhost:8000/api/v1/conversions'
params = {
  'from_date': '2026-01-01',
  'to_date': '2026-06-30',
  'page': '1',
  'limit': '25',
}
headers = {
  'Authorization': 'Bearer {your_access_token}',
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}

response = requests.request('GET', url, headers=headers, params=params)
response.json()</code></pre>
        </div>

      </span>

      <span id="example-responses-GETapi-v1-conversions">
        <blockquote>
          <p>Example response (200):</p>
        </blockquote>
        <pre>

<code class="language-json" style="max-height: 300px;">{
&quot;success&quot;: true,
&quot;message&quot;: &quot;Success&quot;,
&quot;data&quot;: {
    &quot;items&quot;: [
        {
            &quot;conversion_id&quot;: &quot;b7e82fcc5d3c868c233b685975f43f2fa85bfcfc&quot;,
            &quot;order_code&quot;: &quot;1100l2426323454&quot;,
            &quot;order_time&quot;: &quot;2026-06-01 23:42:12&quot;,
            &quot;price&quot;: null,
            &quot;quantity&quot;: 1,
            &quot;commission&quot;: null,
            &quot;status&quot;: &quot;Pending&quot;,
            &quot;product_code&quot;: &quot;1100l1077340452&quot;,
            &quot;product_name&quot;: &quot;Home-Concert Tickets-Artists T - Z-Vacations&quot;,
            &quot;confirmed_at&quot;: null,
            &quot;paid_at&quot;: null,
            &quot;campaign_id&quot;: 44
        },
        ...
    ],
    &quot;pagination&quot;: {
        &quot;page&quot;: 1,
        &quot;perPage&quot;: 25,
        &quot;total&quot;: 168,
        &quot;lastPage&quot;: 7,
        &quot;from&quot;: 1,
        &quot;to&quot;: 25
     }
   }
}</code>
 </pre>
      </span>
      <span id="execution-results-GETapi-v1-conversions" hidden>
        <blockquote>Received response<span id="execution-response-status-GETapi-v1-conversions"></span>:
        </blockquote>
        <pre class="json"><code id="execution-response-content-GETapi-v1-conversions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
      </span>
      <span id="execution-error-GETapi-v1-conversions" hidden>
        <blockquote>Request failed with error:</blockquote>
        <pre><code id="execution-error-message-GETapi-v1-conversions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
      </span>
      <form id="form-GETapi-v1-conversions" data-method="GET" data-path="api/v1/conversions" data-authed="1"
        data-hasfiles="0" data-isarraybody="0" autocomplete="off"
        onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-conversions', this);">
        <h3>
          Request&nbsp;&nbsp;&nbsp;
          <button type="button"
            style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
            id="btn-tryout-GETapi-v1-conversions" onclick="tryItOut('GETapi-v1-conversions');">Try it out ⚡
          </button>
          <button type="button"
            style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
            id="btn-canceltryout-GETapi-v1-conversions" onclick="cancelTryOut('GETapi-v1-conversions');" hidden>Cancel
            🛑
          </button>&nbsp;&nbsp;
          <button type="submit"
            style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
            id="btn-executetryout-GETapi-v1-conversions" data-initial-text="Send Request 💥"
            data-loading-text="⏱ Sending..." hidden>Send Request 💥
          </button>
        </h3>
        <p>
          <small class="badge badge-green">GET</small>
          <b><code>api/v1/conversions</code></b>
        </p>
        <h4 class="fancy-heading-panel"><b>Headers</b></h4>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="Authorization" class="auth-value"
            data-endpoint="GETapi-v1-conversions" value="Bearer {your_access_token}" data-component="header">
          <br>
          <p>Example: <code>Bearer {your_access_token}</code></p>
        </div>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="Content-Type" data-endpoint="GETapi-v1-conversions"
            value="application/json" data-component="header">
          <br>
          <p>Example: <code>application/json</code></p>
        </div>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
          &nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="Accept" data-endpoint="GETapi-v1-conversions"
            value="application/json" data-component="header">
          <br>
          <p>Example: <code>application/json</code></p>
        </div>
        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>from_date</code></b>&nbsp;&nbsp;
          <small>string</small>&nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="from_date" data-endpoint="GETapi-v1-conversions"
            value="2026-01-01" data-component="query">
          <br>
          <p>From Date. Example: <code>2026-01-01</code></p>
        </div>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>to_date</code></b>&nbsp;&nbsp;
          <small>string</small>&nbsp;
          &nbsp;
          &nbsp;
          <input type="text" style="display: none" name="to_date" data-endpoint="GETapi-v1-conversions"
            value="2026-06-30" data-component="query">
          <br>
          <p>To Date. Example: <code>2026-06-30</code></p>
        </div>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
          <small>number</small>&nbsp;
          <i>optional</i> &nbsp;
          &nbsp;
          <input type="number" style="display: none" step="any" name="page"
            data-endpoint="GETapi-v1-conversions" value="1" data-component="query">
          <br>
          <p>Page number. Example: <code>1</code></p>
        </div>
        <div style="padding-left: 28px; clear: unset;">
          <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
          <small>number</small>&nbsp;
          <i>optional</i> &nbsp;
          &nbsp;
          <input type="number" style="display: none" step="any" name="limit"
            data-endpoint="GETapi-v1-conversions" value="25" data-component="query">
          <br>
          <p>Items each page. Example: <code>25</code></p>
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
