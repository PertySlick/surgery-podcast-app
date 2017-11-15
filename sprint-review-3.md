# CodeWorks - Sprint Review 2
*Author: Tim Roush (PertySlick) - 11/14/17*

### Current Development Site Location

[The Surgery Podcast](http://surgerypodcast.greenrivertech.net)

### Product Backlog Location (Trello) *Access Permission Required*

[The Surgery Podcast - Product Backlog](https://trello.com/b/6gTgrtVA/the-surgery-podcast-app)

### Sprint User Testing Report

[Sprint 3 User Testing Report.pdf](https://mailgreenriver-my.sharepoint.com/personal/troush_mail_greenriver_edu/_layouts/15/guestaccess.aspx?docid=1dc7a4e7a47124c168f368e929a2ef1f8&authkey=AQdZnmj9FgUormT7wq1wZU8&e=c3bb979c4b3640f082ea9536341ce762)

### Sprint User Stories

1. **Research Alternate Web Host** - 2
  - *As a product owner I need to know what options are available in case my current services cannot provide the necessary functionality.*
  - At the moment we are not entirely confident that Kevin's current web host (Wordpress) will allow us access to a database.  We should be ready with alternate host providers.
  - **Definition Of Done**
    - [x] Find multiple options for alternate web hosts
    - [x] Provide info on price, features, etc...
    - [x] Prefer a MySQL database host
    - [x] Present findings to customer
  - **Developer(s)**
    - Marlene Leano (mleano)
  - **Link To View Results**
    - [Alternative Web Hosts.docx](https://mailgreenriver-my.sharepoint.com/personal/troush_mail_greenriver_edu/_layouts/15/guestaccess.aspx?docid=10f1279f3fe77478494fae8c43ebae1d3&authkey=Ac_692PqSPXxqR0V1VdzTsw&e=92ea6d98c7dc4f16968e9b7e2d257065)
  - **Progress and Notes**
    - Research was completed and presented.  However, we were able to determine via further information from the product owner that the current level of Wordpress service does infact include custom database access.

2. **Convert App To IFrame Overlay Design** - 5
  - *As a user I want to be able to have a stationary navigation and podcast player to allow me to browse the site while listening to a podcast.*
  - The idea is to create a main page that displays a fixed top navigation bar as well as a fixed bottom podcast player.  This will enable fixed navigation as well as the ability to browse the app while listening to a podcast.
  - **Definition Of Done**
    - [x] IFrame is created and functional
    - [x] Home button on top navigation causes the IFrame to load the home page
    - [x] IFrame and navigation components are styled to fit and look good.
  - **Developer(s)**
    - Brent Taylor (Brent253)
    - Tim Roush (PertySlick)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net)
  - **Progress and Notes**
    - Task was completed and is fully functional.

3. **Complete Custom Player Interface** - 3
  - *As a user I want to be able to play podcasts with an easy to use interface.*
  - *As a product owner I want a custom podcast player interface that looks consistent across multiple browsers and platforms.*
  - **Definition Of Done**
    - [x] Podcast can play, skip forward/backward, stop, close, or download
    - [x] Podcast should open when podcast row is clicked and load selected podcast
    - [x] Podcast player has a functioning progress/seek bar
    - [x] Podcast player correctly shows total podcast duration as well as current position
    - [x] Complete appearance and design
  - **Developer(s)**
    - Tim Roush (PertySlick)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net)
  - **Progress and Notes**
    - Podcast player is fully functional and cooperates with IFrame displayed Podcast search result rows. - PertySlick

4. **Script To Parse XML Data From Libsyn** - 3
  - *As a product owner I want to utilize data available from my current podcast host to populate a database on my own site to provide further functionality.*
  - LibSyn provides an XML representation of the client's entire podcast library.  We need a script that can parse this XML data into a usable format and input it into our own database.
  - **Definition Of Done**
    - [x] XML data has been successfully parsed and checked for errors
    - [x] Parsed data inserts into our database and checked for errors
    - [x] Operator method to insert new entries
    - [x] Peer Review
  - **Developer(s)**
    - Nathan Strand (NStrand42)
  - **Link To View Results**
    - None
  - **Progress and Notes**
    - Script successfully parses all data and inserts it into our database.  Database data has been check for errors and I peer reviewed the code.  One observation made was the LibSyn RSS feed does not include unique identifiers for each podcast.  This eliminates the possibility of modifying this script to update the database in the future.  Instead it must do a "wipe" and fresh install of database data. - PertySlick

5. **Complete Podcast List Display** - 5
  - *As a user I want a user-friendly way of seeing all podcasts in a search list or topic.*
  - Podcasts should display in a list of rows showing titles.  When title rows are clicked it expands accordion style to show more relevant podcast data.  It should also open the custom player to enable playing or downloading the podcast directly.
  - **Definition Of Done**
    - [x] Database query successfully pulls data and returns array of podcast objects
    - [x] Podcast results template loads in and displays an array of podcast objects
    - [x] Each result row has a functioning accordion feature
    - [x] Each result row displays a full title, description, and duration
  - **Developer(s)**
    - Marlene Leano (mleano), Tim Roush (PertySlick)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net) - (Click a topic to see this result)
  - **Progress and Notes**
    - Results are displayed in an MVC templating format thus providing us a template to use for all podcast search results.  Accordion feature for each row was implemented and functions well. - PertySlick

### Files Created / Modified

- [XMLParser.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/classes/XmlParser.php)
  - Modified by: Nathan Strand (NStrand42)
  - Peer reviewed by: Tim Roush (PertySlick)
- [dbOperator.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/model/dboperator.php)
  - Modified by: Marlene Leano (mleano), Tim Roush (PertySlick)
  - Peer reviewed by: Tim Roush (PertySlick)
- [controller.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/controller/controller.php)
  - Modified by: Brent Taylor (Brent253), Marlene Leano (mleano), Tim Roush (PertySlick)
  - Peer reviewed by: Tim Roush (PertySlick)
- [styles.css](https://github.com/PertySlick/surgery-podcast-app/blob/master/css/styles.css)
  - Modified by: Brent Taylor (Brent253), Marlene Leano (mleano), Tim Roush (PertySlick)
  - Peer reviewed by: Tim Roush (PertySlick)
- [index.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/index.php)
  - Modified by: Brent Taylor (Brent253), Marlene Leano (mleano), Tim Roush (PertySlick)
  - Peer reviewed by: Tim Roush (PertySlick)
- [podcastresults.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/view/podcastresults.html)
  - Created/modified by: Marlene Leano (mleano)
  - Peer reviewed by: Tim Roush (PertySlick)
- [new-footer.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/new-footer.inc.html)
  - Removed by: Tim Roush (PertySlick)
- [new-header.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/new-header.inc.html)
  - Removed by: Tim Roush (PertySlick)
- [footer.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/footer.inc.html)
  - Modified by: Tim Roush (PertySlick)
  - Peer reviewed by: None
- [header.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/header.inc.html)
  - Modified by: Tim Roush (PertySlick)
  - Peer reviewed by: None
- [results.js](https://github.com/PertySlick/surgery-podcast-app/blob/master/js/results.js)
  - Created/modified by: Marlene Leano (mleano)
  - Peer reviewed by: Tim Roush (PertySlick)
- [player.js](https://github.com/PertySlick/surgery-podcast-app/blob/master/js/player.js)
  - Modified by: Tim Roush (PertySlick)
  - Peer reviewed by: None


### Product Owner Review / Comments

 - Nathan is currently trying to schedule a product owner meeting - 11/14/17 PertySlick

### Final Review Notes

Our focus this goal was to achieve a solid MVP.  An observation was made this sprint that our sprint plans were in effect segregating the developers and were not encompassing end-to-end functionality.  So this sprint we reorganized and restructured our user stories to adapt.

Solid MVP was achieved with all primary functionality in combination with the alternate design ideas the product owner approved last sprint.  From this point forward every sprint and user story will be an improvement on the product as it is.  We also had a more structured and effective user testing procedure as well as documentation to record the results.
