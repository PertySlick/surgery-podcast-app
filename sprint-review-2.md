# CodeWorks - Sprint Review 2
*Author: Tim Roush (PertySlick) - 11/01/17*

### Current Development Site Location

[The Surgery Podcast](http://surgerypodcast.greenrivertech.net)

### Product Backlog Location (Trello) *Access Permission Required*

[The Surgery Podcast - Product Backlog](https://trello.com/b/6gTgrtVA/the-surgery-podcast-app)

### Sprint User Stories

1. **Script To Parse XML Data From Libsyn** - 5
  - *As a product owner I want to utilize data available from my current podcast host to populate a database on my own site to provide further functionality.*
  - LibSyn provides an XML representation of the client's entire podcast library.  We need a script that can parse this XML data into a usable format and input it into our own database.
  - **Definition Of Done**
    - [x] XML data has been successfully parsed and checked for errors
    - [ ] Parsed data inserts into our database and checked for errors
  - **Developer(s)**
    - Nathan Strand (NStrand42)
  - **Link To View Results**
    - None
  - **Progress and Notes**
    - Script has been written and produces an HTML output of the RSS feed podcast values.  We do still need to modify this process to actually insert the data into the database itself. - PertySlick
  - **User Testing**
    - None

2. **Initialize Database Setup** - 5
  - *As a product owner I need a database setup so that I can manage an admin user as well as podcast data storage.*
  - Database needs to be set up to store a site admin's user data including a username, password, and email.
  - Database also needs to be set up to store podcast data.  This will require multiple tables for normalization.
  - **Definition Of Done**
    - [x] Admin table is initialized
    - [ ] Admin user is registered
    - [x] Podcast tables are initialized
    - [ ] A test podcast has been entered via SQL commands as a test
  - **Developer(s)**
    - Brent Taylor (Brent253)
    - Tim Roush (PertySlick)
  - **Link To View Results**
    - None
  - **Progress and Notes**
    - Tables are created but testing has not completed successfully.  Podcast/Tag join table is not it use and an admin is not properly registered yet. - PertySlick
  - **User Testing**
    - None

3. **Create Fat-free DB Operator** - 5
  - *As a product owner I want a framework setup to separate database functionality into a separate controller class.*
  - Our Fat-free framework needs to have a database operator class added to implement interactivity with the database.  This will involve all the necessary SQL queries and commands as well as returning the data or responses in a usable format.
  - **Definition Of Done**
    - [x] Operator class has been created
    - [ ] Operator class performs necessary functions
    - [ ] Operator class returns data in a usable format
  - **Developer(s)**
    - Brent Taylor (Brent253)
    - Tim Roush (PertySlick)
  - **Link To View Results**
    - None
  - **Progress and Notes**
    - Operator class has been created but has a few bugs and needs review.  Not yet implemented or usable - PertySlick
  - **User Testing**
    - None

4. **Produce Alternative Design Ideas** - 8
  - *As a product owner I would like to see alternative design ideas to possible improve the user experience of this application.*
  - Research and produce examples of alternative design implementations.  Consider improving functionality, user experience, as well as look and feel.
  - **Definition Of Done**
    - [x] Researched multiple alternative sites
    - [x] Produces examples of alternative designs or concepts
    - [ ] Product Owner has reviewed and rejected or selected ideas
  - **Developer(s)**
    - Tim Roush (PertySlick)
  - **Link To View Results**
    - [Alternate Design: New Topic Page](http://surgerypodcast.greenrivertech.net/newtopic)
  - **Progress and Notes**
    - Research was done on other podcast related sites as well as some UX/UI informational sites.  New alternative design rough draft created with mobile users in mind as well as reducing clicks while improving navigation.  Client will be reviewing Wednesday 11/01/17. - PertySlick
  - **User Testing**
    - A small group of users familiar with podcast use performed some testing on the rough draft.  Color scheme was not well accepted but from what they could tell without full functionality, the design seemed intuitive and manageable for mobile use.

### Files Created / Modified

- [XMLParser.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/classes/XmlParser.php)
  - Created/modified by: Nathan Strand (NStrand42)
  - Peer reviewed by: Tim Roush (PertySlick)
- [Operator.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/dboperator.php)
  - Created/modified by: Brent Taylor (Brent253)
  - Peer reviewed by: Tim Roush (PertySlick)
- File Group:
  - [styles.css](https://github.com/PertySlick/surgery-podcast-app/blob/master/css/styles.css)
  - [index.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/index.php)
  - [newtopic.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/view/newtopic.html)
  - [new-footer.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/new-footer.inc.html)
  - [new-header.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/new-header.inc.html)
  - [player.js](https://github.com/PertySlick/surgery-podcast-app/blob/master/js/player.js)
  - Created/modified by: Tim Roush (PertySlick)
  - Peer reviewed by: None

### Product Owner Review / Comments

Client meeting scheduled for 11/01/17

### Final Review Notes

The main focus of this sprint was functionality to compliment the visual product produced in the last sprint.  We encountered a few obstacles this time around including:
  - Team member Marlene Leano (mleano) had a major health concern that effectively removed her from the sprint.
  - We quickly discovered that our sprint plan included team members waiting on others to produce before they could start.
  - Complications regarding determining what exactly the client currently has as far as a web host provider and possible database accessibility.
  - A few technical skill issues that caused delays.

Moving forward we plan to adapt our plan to better mitigate the potential for the avoidable obstacles in the future.