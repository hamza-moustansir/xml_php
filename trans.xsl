<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml">
    
    <xsl:template match="/ests">
        <html>
            <head>
                <title>ests</title>
                <style>
          .logoutbutton {
          text-align: right;
          }
          body {
          font-family: 'lato', sans-serif;
          }
          .container {
          max-width: 1000px;
          margin-left: auto;
          margin-right: auto;
          padding-left: 10px;
          padding-right: 10px;
          }

          h2 {
          font-size: 26px;
          margin: 20px 0;
          text-align: center;
          small {
          font-size: 0.5em;
          }
          }

          .responsive-table {
          li {
          border-radius: 3px;
          padding: 25px 30px;
          display: flex;
          justify-content: space-between;
          margin-bottom: 25px;
          }
          .table-header {
          background-color: #95A5A6;
          font-size: 14px;
          text-transform: uppercase;
          letter-spacing: 0.03em;
          }
          .table-row {
          background-color: #ffffff;
          box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
          }
          .col-1 {
          flex-basis: 10%;
          }
          .col-2 {
          flex-basis: 25%;
          }
          .col-3 {
          flex-basis: 25%;
          }
          .col-4 {
          flex-basis: 25%;
          }
          .col-5 {
          flex-basis: 28%;
          }

          @media all and (max-width: 767px) {
          .table-header {
          display: none;
          }
          .table-row{

          }
          li {
          display: block;
          }
          .col {

          flex-basis: 100%;

          }
          .col {
          display: flex;
          padding: 10px 0;

          }
          }
          }
          .logoutbutton {
          text-align: right;
          }
          .btn {
          padding: 5px 10px;
          margin: 2px;
          font-size: 11px;
          cursor: pointer;
          background-color: #3498db;
          color: #fff;
          border: none;
          border-radius: 5px;
          text-decoration: none;
          }

          .btn:hover {
          background-color: #2980b9;
          }
                </style>
                
            </head>
            <body>
                <div  class="logoutbutton">
                 <input type='button' value='logout' onclick="window.location.href='logout.php'" /></div>

                 <div class="container">
  <h2>Table de candidats <small>inscrit à licence professionnelle</small></h2>
  <ul class="responsive-table">
    
    <li class="table-header">
      <div class="col col-1">Id</div>
      <div class="col col-2">CNE</div>
      <div class="col col-3">prenom</div>
      <div class="col col-3">nom</div>
      <div class="col col-4">Status</div>
      <div class="col col-5">Actions</div>
    </li>
    <xsl:for-each select="//candidate">
    <li class="table-row">
      <div class="col col-1"><xsl:value-of select="id"/></div>
      <div class="col col-2"><xsl:value-of select="cne"/></div>
      <div class="col col-3"><xsl:value-of select="prenom"/></div>
      <div class="col col-3"><xsl:value-of select="nom"/></div>
      <div class="col col-4"><xsl:value-of select="status"/></div>
      <div class="col col-5">
        <input type='button' class="btn"
                    value='Profile'
                    onclick="window.location.href='profile.php?id={id}'" />
                  <input type='button' class="btn" value='Reponse'
                    onclick="window.location.href='reponse.php?id={id}'" />
                  <input type='button' class="btn"
                    value='Delete'
                    onclick="window.location.href='delete.php?id={id}'" />
                  </div>
    </li>
    </xsl:for-each>
  </ul>
</div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
