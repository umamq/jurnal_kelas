<html>
   <head>
      <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
      <style type="text/css">
        /*!
        Pure v0.6.0
        Copyright 2014 Yahoo! Inc. All rights reserved.
        Licensed under the BSD License.
        https://github.com/yahoo/pure/blob/master/LICENSE.md
        */
        .pure-table {
            /* Remove spacing between table cells (from Normalize.css) */
            border-collapse: collapse;
            border-spacing: 0;
            empty-cells: show;
            border: 1px solid #cbcbcb;
            width: 100%;
        }

        .pure-table caption {
            color: #000;
            font: italic 85%/1 arial, sans-serif;
            padding: 1em 0;
            text-align: center;
        }

        .pure-table td,
        .pure-table th {
            border-left: 1px solid #cbcbcb;/*  inner column border */
            border-width: 0 0 0 1px;
            font-size: inherit;
            margin: 0;
            overflow: visible; /*to make ths where the title is really long work*/
            padding: 0.5em 1em; /* cell padding */
        }

        /* Consider removing this next declaration block, as it causes problems when
        there's a rowspan on the first cell. Case added to the tests. issue#432 */
        .pure-table td:first-child,
        .pure-table th:first-child {
            border-left-width: 0;
        }

        .pure-table thead {
            background-color: #e0e0e0;
            color: #000;
            text-align: left;
            vertical-align: bottom;
        }

        /*
        striping:
           even - #fff (white)
           odd  - #f2f2f2 (light gray)
        */
        .pure-table td {
            background-color: transparent;
        }
        .pure-table-odd td {
            background-color: #f2f2f2;
        }

        /* nth-child selector for modern browsers */
        .pure-table-striped tr:nth-child(2n-1) td {
            background-color: #f2f2f2;
        }

        /* BORDERED TABLES */
        .pure-table-bordered td {
            border-bottom: 1px solid #cbcbcb;
        }
        .pure-table-bordered tbody > tr:last-child > td {
            border-bottom-width: 0;
        }


        /* HORIZONTAL BORDERED TABLES */

        .pure-table-horizontal td,
        .pure-table-horizontal th {
            border-width: 0 0 1px 0;
            border-bottom: 1px solid #cbcbcb;
        }
        .pure-table-horizontal tbody > tr:last-child > td {
            border-bottom-width: 0;
        }
      </style>
   </head>
   <body>
    <h3 style="text-align: center;"><?php echo $header;?></h3>
   	 <table class="pure-table pure-table-bordered">
          <thead>
            <?php $fields = $rs->list_fields(); ?>
              <tr>
                  <?php foreach ($fields as $field) { ?>
                  <th><?php echo strtoupper(str_replace('_', ' ', $field))?></th>
                  <?php } ?>
              </tr>
          </thead>

          <tbody>
           <?php foreach ($rs->result() as $data) { ?>
              <tr>
              <?php foreach ($fields as $field) { ?>
                  <td><?php echo nl2br($data->$field)?></td>
              <?php } ?>
              </tr>
           <?php } ?>
          </tbody>
      </table>
   </body>
</html>
