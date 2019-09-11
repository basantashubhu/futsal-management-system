<html>
  <head>
    <title>@yield('title')</title>
    <style>
      .body {
        font-size: 13px;
        font-family: "Poppins", Arial, Helvetica, sans-serif;
      }
      table.headerArea {
        width: 100%;
        margin-bottom: 20px;
		border-collapse: collapse;
      }
      table.headerArea tr td {
        width: 40%;
        font-family: "Poppins", Arial, Helvetica, sans-serif;
/*         color: #f5f5f5;
		background-color: #113a5d; */
      }
      table.options {
        width: 40%;
        float: left;
        margin-top: 20px;
        margin-bottom: 20px;
      }
      table.options tr td {
        padding: 5px;
        font-size: 13px;
        font-family: "Poppins", Arial, Helvetica, sans-serif;
      }
      table.options tr td:first-child {
        text-align: right;
      }
      table.dataTable {
        margin-top: 20px;
        width: 100%;
      }
      table.dataTable tr th {
        text-align: left;
      }
      table.dataTable tr th,
      table.dataTable tr td {
        padding: 5px;
        font-size: 13px;
        font-family: "Poppins", Arial, Helvetica, sans-serif;
      }
      /* table.dataTable tbody tr:last-child {
            font-weight: bolder;
        } */
    </style>
  </head>
  <body class="body">
    <table class="headerArea">
      <tr>
        <td>
          <img
            src="{{ base64_logo() }}"
            alt="Email"
            style="background-color:white;display: block; height: 50px;filter: Alpha(opacity=100); opacity: 1;"
          />
        </td>
      </tr>
    </table>

    <main>
      @yield('content')
    </main>
  </body>
</html>
