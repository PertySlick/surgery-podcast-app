<!--
 * File Name: resultsbytopic.html
 * Author: Marlene Leano
 * Date Created: 11/07/2017
 * Assignment: Behind The Knife: The Surgery App
 * Description: List of podcasts related to selected topic
-->

<?php echo $this->render($INC . 'new-header.inc.html',NULL,get_defined_vars(),0); ?>

<h1 class="title">Surgery Legends</h1>
<div class="subtitle">click to play</div>


<div class="new-pc-row pc-title">
    <div class="new-pc-title">Mock Orals #6: Thoracic Surgery with Dr. Kathleen Berfield</div>
</div>
<div class="new-pc-row pc-description">
    <div class="new-pc-desc">
        Dr. Kathleen Berfield, Chief of Thoracic Surgery at the Seattle VA, takes Woo Do and Kevin Kniery through 4 mock oral board scenarios.
    </div>
    <div class="new-pc-duration">01:23:45</div>
</div>

<div class="new-pc-row pc-title">
    <div class="new-pc-title">Ovarian masses and torsion with Dr. Guntupalli (featuring Dominic Forte)</div>
</div>
<div class="new-pc-row pc-description">
    <div class="new-pc-desc">
        Behind the Knife coverage of the 2017 American College of Surgeons Clinical Congress: Dr. Saketh Guntupalli (Gynecologic
        Oncology, University of Colorado) takes Woo Do and Dominic Forte through the workup and management of benign and malignant
        ovarian masses and offers surgical tips for ovarian torsion.
    </div>
    <div class="new-pc-duration">01:23:45</div>
</div>





<?php echo $this->render($INC . 'new-footer.inc.html',NULL,get_defined_vars(),0); ?>
