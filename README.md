Summary
=======
Comment system for a programming challenge.

## Details
The system was developed to the specs below.

Write a website comment system for a website with the following rules:

  * Only name and comment are required fields
  * Page should not refresh when posting a comment
  * Commenters can write a reply to other comments
  * Maximum of 3 levels in nested comments
  * Comments (within in the same level) should be ordered by post date
  * Should filter out malicious text that could result in a security vulnerability
  * Doesn't need to be beautiful but also shouldn't make our eyes hurt
  * No need for edit, delete, moderation, login, ...
  * It's up to you to decide how the comments are stored and what libraries you use.

What we are looking for (in order of importance):

  * Working code that meet requirements
  * Clean and readable code
  * Organization of business logic that makes sense and is maintainable
  * Documentation, when helpful

## Installation
  * Check out the files in this repo
  * Create a (virtual)?host and point it to the `public` directory of this repo
  * From the root of the repo, run `composer install`. [More info about Composer](https://getcomposer.org/) 
  * Copy `conf/config.json.sample` to `conf/config.json` and fill out MySQL credentials
  * Access the app via browser 