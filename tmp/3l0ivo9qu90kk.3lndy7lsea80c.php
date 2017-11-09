
<!--
 * File Name: home.html
 * Author: Timothy Roush
 * Date Created: 10/07/17
 * Assignment: Behind The Knife: The Surgery App
 * Description:  Landing page for a podcast app
-->

 <?php echo $this->render($INC . 'new-header.inc.html',NULL,get_defined_vars(),0); ?>
 
  <iframe src="/home" height="400" width="800" align="left">
  <p>Your browser does not support iframes.</p>
</iframe>

<!--
    * File Name: footer.inc.html
    * Authors: Timothy Roush
    * Date Created: 10/02/17
    * Assignment: Behind The Knife: The Surgery Podcast
    * Description:  Footer content for each page within the app
-->

    <!-- EXTERNAL JAVASCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.15/datatables.min.js"></script>
    <!-- TODO: If not used by end of project, remove this script element -->
    <!-- <script src="/js/scripts.js"></script> -->
    <?php echo $this->render($INC . 'new-footer.inc.html',NULL,get_defined_vars(),0); ?>

