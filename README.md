# WP User Edit

Allow site administrators to edit users of their sites.

WP User Edit allows administrators of sites to edit all users who are explicitly members of that site. This plugin is useful if you have an installation type where administrators are trusted to edit the users of their sites, but not trusted to manage an entire network of users.

# Installation

* Download and install using the built in WordPress plugin installer.
* Activate in the "Plugins" area of your admin by clicking the "Activate" link.
* No further setup or configuration is necessary.

# FAQ

### Does this create new database tables?

No. There are no new database tables with this plugin.

### Does this modify existing database tables?

No. All of WordPress's core database tables remain untouched.

### Does this plugin integrate with user roles?

No. This plugin filters `map_meta_cap` and uses `is_user_member_of_blog()` to restrict `edit_users` capabilities down to users of the current site.

### Where can I get support?

The WordPress support forums: https://wordpress.org/tags/wp-user-edit/

### Can I contribute?

Yes, please! Having an easy-to-use API and powerful set of functions is critical to managing complex WordPress installations. If this is your thing, please help us out!
