# CodeWorks - Sprint Review 4
*Author: Tim Roush (PertySlick) - 11/28/17*

### Current Development Site Location

[The Surgery Podcast](http://surgerypodcast.greenrivertech.net)

### Product Backlog Location (Trello) *Access Permission Required*

[The Surgery Podcast - Product Backlog](https://trello.com/b/6gTgrtVA/the-surgery-podcast-app)

### Sprint User Testing Report

[Sprint 3 User Testing Report.pdf](https://mailgreenriver-my.sharepoint.com/personal/troush_mail_greenriver_edu/_layouts/15/guestaccess.aspx?docid=104d4ee9840b24a35b0aeda963d445430&authkey=Ad73jrjm4jnWbTTCsEowae8&e=04b0b00ec3824f19873af9bebd8abe42)

### Sprint User Stories

1. **Add Mailing List Functionality** - 2
  - *As a user I want to be able to sign up for email announcements or notifications of new podcast content.*
  - *As a product owner I want to be able to collect user data for communication and future monetary purposes.*
  - 
  - **Definition Of Done**
    - [x] Sign up for a MailChimp account
    - [x] Insert simple sign-up form code into new home page design
    - [x] Test to make sure sign up works correctly and is visible from MailChimp account.
  - **Developer(s)**
    - Brent Taylor (Brent253)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net)
  - **Progress and Notes**
    - A demo MailChimp account was established and test users registered.  Form has been inserted into the main home page towards the bottom and styled to match the rest of the site.

2. **Home Page Redesign** - 8
  - *As a user I would like to know what this app is when I arrive and have access to more information about the organization and it's content.*
  - We drew up a paper proto-type for a new home page.  This includes the BTK logo, a small description of the app, the last three uploaded podcasts, a topic search bar (functionality is separate), the topics as specified by the product owner, and a mailing list sign-up form (separate user story).
  - **Definition Of Done**
    - [x] Design resembles paper prototype
    - [x] BTK Logo is displayed
    - [x] Small app description
    - [x] Result rows are displayed for the last three podcasts and they interact with the podcast player
    - [x] Topic search field exists
    - [x] Topics are listed and function
    - [x] All interactions and buttons have some kind of feedback for the user
  - **Developer(s)**
    - Marlene Leano (mleano)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net)
  - **Progress and Notes**
    - Home page was successfully redesigned and implemented.

3. **Convert Navigation To Dropdown Menu** - 3
  - *As a user I want easy access to all options of the site without taking up a lot of the screen view area.*
  - We decided on a re-design of the top navbar to convert it to a button that drops down a list of available site options.  These include: "Home", "Topics", and "About Us".
  - **Definition Of Done**
    - [x] Hamburger button successfully initiates a drop down list
    - [x] All interactions and buttons have some sort of feedback for the user
    - [x] Menu can also be closed by clicking elsewhere or on the hamburger again
  - **Developer(s)**
    - Marlene Leano (mleano)
    - Tim Roush (pertyslick)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net)
  - **Progress and Notes**
    - Menu successfully converted and implemented with functionality to enable navigation, opening menu, and closing menu.

4. **Paper-prototype For Site Redesign** - 3
  - *As a product owner I would like to see an example of how a dynamic suggestion search bar would look and operate before I commit resources to creating it.*
  - Create a paper-prototype for the potential search bar across the top of the drop down menu.  This search bar would provide suggestions based on each keystroke entered dynamically.  It would also limit results to a certain number and provide a "See More" button at the bottom to see all results related to the current query in the podcast results template.
  - **Definition Of Done**
    - [x] Paper prototype has been created to match original design
    - [x] Paper prototype shows all related functionality
    - [x] Paper prototype has been shown to product owner and received approval.
  - **Developer(s)**
    - Nathan Strand (NStrand42)
  - **Link To View Results**
    - [Ninja Mock Paper Prototype](https://ninjamock.com/Designer/Workplace)
  - **Progress and Notes**
    - Paper prototype was presented to product owner and he liked what he saw.  We got the go ahead to proceed with the new design.

5. **Podcast Results Template Redesign** - 8
  - *As a user I want a more user-friendly interface that provides more information for the podcasts I select.*
  - We decided on a re-design for the podcast results page to better display additional and relevant information for each podcast.  Page should be re-worked to match the paper prototype.
  - This includes showing a date on the initial row along with the title.  When click the date moves to another location within the revealed information pane along with full title, description, image, author(s), duration, and topic(s).
  - **Definition Of Done**
    - [x] Resulting page resembles paper prototype
    - [x] Operator pulls all relevant data from the database
    - [x] Controller wraps all relevant data into an array of podcast objects
    - [x] Podcast result rows now show all relevant data for each podcast
    - [x] Clicking a result row now expands the podcasts information without loading the podcast player.
    - [x] Podcast result row now includes a play and download button
    - [x] Date on initial result row performs as expected when clicked
  - **Developer(s)**
    - Nathan Strand (NStrand42)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net) - (Click a topic to see this result)
  - **Progress and Notes**
    - Completed and implemented
    
6. **Topics search/refine feature for home page** - 3
  - *As a user I would like to be able to search through or sort the available topics for finding podcasts.*
  - Implement a search/refinement feature using AJAX to sort or filter the topics list display to match the input query.
  - **Definition Of Done**
    - [x] AJAX Call is written and works.
    - [x] AJAX Operator is created and tested.
    - [x] JavaScript is written to build topic list dynamically based on input
    - [x] User can enter text string and watch topic list adapt to match
  - **Developer(s)**
    - Tim Roush (pertyslick)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net)
  - **Progress and Notes**
    - Topic list is refined to results that match query input as the user types.  If query returns no results, the original list is shown with a message indicating such.
    
### Files Created / Modified

- [Podcast.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/classes/Podcast.php)
  - Modified by: Nathan Strand (NStrand42)
  - Peer reviewed by: Tim Roush (pertyslick)
- [home.css](https://github.com/PertySlick/surgery-podcast-app/blob/master/css/home.css)
  - Created by: Marlene Leano (mleano)
  - Peer reviewed by: None
- [player.scss](https://github.com/PertySlick/surgery-podcast-app/blob/master/css/player.scss)
  - Created by: Tim Roush (pertyslick)
  - Peer reviewed by: None
- [player.css](https://github.com/PertySlick/surgery-podcast-app/blob/master/css/player.css)
  - Created by: Tim Roush (pertyslick) - Auto-generated compiled SASS
  - Peer reviewed by: None
- [styles.css](https://github.com/PertySlick/surgery-podcast-app/blob/master/css/styles.css)
  - Modified by: Brent Taylor (Brent253), Marlene Leano (mleano), Nathan Strand (NStrand42), Tim Roush (pertyslick)
  - Peer reviewed by: Tim Roush (PertySlick)
- [footer.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/footer.inc.html)
  - Modified by: Marlene Leano (mleano), Tim Roush (PertySlick)
  - Peer reviewed by: Tim Roush (PertySlick)
- [header.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/header.inc.html)
  - Modified by: Marlene Leano (mleano), Tim Roush (PertySlick)
  - Peer reviewed by: Tim Roush (PertySlick)
- [player.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/player.inc.html)
  - Created by: Tim Roush (PertySlick)
  - Peer reviewed by: None
- [player.js](https://github.com/PertySlick/surgery-podcast-app/blob/master/js/player.js)
  - Modified by: Tim Roush (PertySlick)
  - Peer reviewed by: None
- [menu.js](https://github.com/PertySlick/surgery-podcast-app/blob/master/js/menu.js)
  - Created/modified by: Marlene Leano (mleano), Tim Roush (PertySlick)
  - Peer reviewed by: Tim Roush (PertySlick)
- [topic-refiner.js](https://github.com/PertySlick/surgery-podcast-app/blob/master/js/topic-refiner.js)
  - Created by: Tim Roush (PertySlick)
  - Peer reviewed by: None
- [ajaxOperator.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/model/ajaxoperator.php)
  - Created by: Tim Roush (PertySlick)
  - Peer reviewed by: None
- [podcastresults.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/view/podcastresults.html)
  - Modified by: Nathan Strand (NStrand42)
  - Peer reviewed by: Tim Roush (PertySlick)
- [home.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/view/home.html)
  - Modified by: Marlene Leano (mleano)
  - Peer reviewed by: Tim Roush (PertySlick)
- [iframe.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/view/iframe.html)
  - Modified by: Marlene Leano (mleano)
  - Peer reviewed by: Tim Roush (PertySlick)

### Product Owner Review / Comments

 - Product owner is pleased, dare I say excited, at the progress made.  The new redesign presented was very well accepted.  He proposed a few tweaks here and there for the next, and final, sprint.

### Final Review Notes

 - The main focus of this sprint was to evaluate and respond to the data acquired during usability testing in Sprint 4.  A secondary goal was to implement some major functionality in the process.  Navigational hurdles as well as user experience issues were of top priority.  We quickly moved to design a fix for the revealed flaws, present this design to the product owner for approval, and then moved straight into implementation.
 
 - The result is that we not only maintained MVP, but we vastly improved upon it.  Usability testing this sprint revealed a few little things that can be modified to improve user experience.  But nothing was quite as major as the previous round of testing.
