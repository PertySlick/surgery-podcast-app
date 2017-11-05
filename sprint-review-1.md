# CodeWorks - Sprint Review 1
*Author: Tim Roush (PertySlick) - 11/01/17*

### Current Development Site Location

[The Surgery Podcast](http://surgerypodcast.greenrivertech.net)

### Product Backlog Location (Trello) *Access Permission Required*

[The Surgery Podcast - Product Backlog](https://trello.com/b/6gTgrtVA/the-surgery-podcast-app)

### Sprint User Stories

1. **Research LibSyn Alternatives** - 5
  - *As a product owner I want to know if there are options available if my current podcast hosting provider cannot provide the access I need to current content.*
  - LibSyn may not provide the access necessary to accomplish the product owner's goals.  We need to investigate the possibility of switching to an alternative provider if necessary.
  - **Definition Of Done**
    - [x] Multiple alternative providers have been researched
    - [x] Findings were presented to the product owner for consideration
  - **Developer(s)**
    - Brent Taylor (Brent253)
  - **Link To View Results**
    - None
  - **Progress and Notes**
    - Research was completed but determined unnecessary as a "work-around" was discovered for remaining with the current provider (LibSyn) - PertySlick
  - **User Testing**
    - None

2. **Research PO's Current Database Availability** - 2
  - *As a developer I need to know if the product owner's current web host provides the services necessary to accomplish our MVP*
  - Customer currently has a website.  We need to know where it is hosted, how to access it, and what capabilities it provides.
  - **Definition Of Done**
    - [ ] Web host information and credentials supplied by PO
    - [ ] Web host capabilities researched
    - [ ] Results presented to team for consideration
  - **Developer(s)**
    - Nathan Strand (NStrand42)
  - **Link To View Results**
    - None
  - **Progress and Notes**
    - Customer was not able to provide web host information or credentials in time to accomplish this research. - PertySlick
  - **User Testing**
    - None
    
3. **Research PO's Current Podcast Hosting Provider** - 2
  - *As a developer I need to know if the product owner's current podcast host will provide the access we require*
  - Customer currently has all podcast content hosted on LibSyn.  We need to know if LibSyn has a method for accessing this content as a developer via API or some interface.
  - **Definition Of Done**
    - [x] Podcast host information and credentials supplied by PO
    - [x] Podcast host capabilities researched
    - [x] Results presented to team for consideration
  - **Developer(s)**
    - Nathan Strand (NStrand42)
  - **Link To View Results**
    - [Behind The Knife: The Surgery Podcast RSS Feed](http://www.behindtheknife.libsyn.com/rss)
  - **Progress and Notes**
    - LibSyn does not provide access to their database to developers yet as the are implementing this feature via an API in the future, but it is currently in closed BETA.  Nathan discovered the above RSS feed that is supplied for iTunes to collect Podcast information for their use.  We have determined we can make use of the same feed to couple our functionality with it on our own database.
  - **User Testing**
    - None

4. **Start Routing Framework** - 2
  - *As a developer I need a framework in place to begin adding functionality and navigation to this application.*
  - Install and initialize FatFree Framework on the app domain.
  - **Definition Of Done**
    - [x] Domain access has been acquired (From Ken)
    - [x] Fat Free Framework has been installed on domain
    - [x] Initial composer dependencies have been set
    - [x] Controller class file has been initialized
    - [x] index.php route file has been initialized
  - **Developer(s)**
    - Marlene Leano (mleano)
  - **Link To View Results**
    - [The Surgery Podcast](http://surgerypodcast.greenrivertech.net)
  - **Progress and Notes**
    - Operator class has been created but has a few bugs and needs review.  Not yet implemented or usable - PertySlick
  - **User Testing**
    - None

5. **Create Landing Page** - 2
  - *As a user I would like an easy way to visit this app and see the topics of podcasts available to browse.*
  - Create a rough draft landing page in HTML and CSS to replicate the design provided by the PO.
  - **Definition Of Done**
    - [x] HTML page has been created and styled to resemble PO's design specification
    - [x] Page has been shown to PO and they have approved it
  - **Developer(s)**
    - Tim Roush (PertySlick)
  - **Link To View Results**
    - [The Surgery Podcast - Topics](http://surgerypodcast.greenrivertech.net/topic)
  - **Progress and Notes**
    - Replicated PO's design with very minimal functionality.  This includes being able to click through to navigate to other demo pages.
  - **User Testing**
    - None
6. **Create Play Page** - 2
  - *As a user I would like to see a custom podcast player interface while I stream content.*
  - Create a rough draft play page in HTML and CSS to replicate the design provided by the PO.
  - **Definition Of Done**
    - [x] HTML page has been created and styled to resemble PO's design specification
    - [x] Page has been shown to PO and they have approved it
  - **Developer(s)**
    - Tim Roush (PertySlick)
  - **Link To View Results**
    - [The Surgery Podcast - Player](http://surgerypodcast.greenrivertech.net/play)
  - **Progress And Notes**
    - Replicated PO's design with very minimal functionality.  This includes being able to click through to navigate to other demo pages and play a static music file.
  - **User Testing**
    - None

### Files Created / Modified

- File Group:
  - /vendor/ (Fat Free Installation)
  - [index.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/index.php)
  - [controller.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/controller/controller.php)
  - Created/modified by: Marlene Leano (mleano)
  - Peer reviewed by: Tim Roush (PertySlick)
- File Group:
  - [styles.css](https://github.com/PertySlick/surgery-podcast-app/blob/master/css/styles.css)
  - [index.php](https://github.com/PertySlick/surgery-podcast-app/blob/master/index.php)
  - [topic.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/view/newtopic.html)
  - [player.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/view/player.html)
  - [footer.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/footer.inc.html)
  - [header.inc.html](https://github.com/PertySlick/surgery-podcast-app/blob/master/includes/header.inc.html)
  - Created/modified by: Tim Roush (PertySlick)
  - Peer reviewed by: None

### Product Owner Review / Comments

  - PO loved seeing his design on screen
  - PO has not been able to get web host information or credentials yet
  - End goal is to have a useable web app that gives a potential future developer a starting point for an actual iOS app

### Final Review Notes

Main objective for this spring was to provide a visual MVP replicating the PO's original design so he could see it in action as well as prepare ourselves in case the current service providers would not provide necessary access.  We also got a start on some functionality by implementing our framework.
The next sprint will focus on functionality.