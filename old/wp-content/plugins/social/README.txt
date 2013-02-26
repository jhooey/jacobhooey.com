=== Social ===
Contributors: crowdfavorite, alexkingorg
Tags: comments, facebook, twitter
Requires at least: 3.2
Tested up to: 3.3rc1
Stable tag: 2.0

Broadcast posts to Twitter and/or Facebook, pull in items from each as comments, and allow commenters to use their Twitter/Facebook identities.

== Description ==

Brought to you by [MailChimp](http://mailchimp.com/), [Social](http://mailchimp.com/social-plugin-for-wordpress/) is a lightweight plugin that handles a lot of the heavy lifting of making your blog seamlessly integrate with social networking sites [Twitter](http://twitter.com/) and [Facebook](http://facebook.com/).

**Broadcast Published Posts**

Through use of a proxy application, you can associate your Twitter and Facebook accounts with your blog and its users. Once you publish a new post, you can then choose to automatically broadcast a message to any accounts authenticated with the overall blog or your current logged-in user.

- Automatically broadcast posts to Twitter and/or Facebook
- Supports multiple accounts associated per user and per blog
- Customize the broadcast message using tokens

**Pull in Tweets and Replies as Comments**

When publishing to Facebook and Twitter, the discussion is likely to continue there. Through Social, we can aggregate the various mentions, retweets, @replies, comments and responses and republish them as WordPress comments.

- Automatically polls Twitter and Facebook for mentions of your post
- Displays mentions inline with comments
- Filter comments by originating source (Facebook, Twitter, or your blog as comments)
- Allow users to reply to the offsite responses

**Comment as Facebook and/or Twitter Identity**

Many individuals use Facebook or Twitter as their primary identity(ies) on the web. Allow your commenters to log in and leave a comment as that identity. Furthermore, they can publish their response directly to their Twitter or Facebook account.

- Allow users to leave comments as Facebook or Twitter identity
- Twitter hovercard support (with @anywhere API key)
- Links point back to users' Facebook or Twitter profiles
- Indicators let you and visitors know people are who they say they are

**Developers**

Please [fork, contribute and file technical bugs on GitHub](https://github.com/crowdfavorite/wp-social).

== Installation ==

1. Upload `social` to the `/wp-content/plugins/` directory or install it from the Plugin uploader
2. Activate the plugin through the `Plugins` menu in the WordPress administrator dashboard
3. Visit the settings page under `Settings > Social` to add Twitter and Facebook accounts for all authors on your site
4. Visit your profile page under `Users > Profile` to add Twitter and Facebook accounts that only you can broadcast to
5. Make sure your plugin or uploads directory writable to allow the cron jobs to fetch new comments from Twitter and Facebook
6. (Optional) Register for and add your [Twitter @anywhere API key](http://dev.twitter.com/anywhere) to the settings page to enable Twitter hovercards

== Upgrade Notice ==

Social 2.0 is a ground-up rewrite from 1.x and a highly recommended upgrade for all users. Enhancements include posting to Facebook Pages, bringing in Facebook Likes, improved Retweet comment display and numerous bug fixes and changes to increase reliability.

If you have customized your Social comment templates or CSS, please refer to the [Upgrade Guide on GitHub](https://github.com/crowdfavorite/wp-social/wiki/Upgrading-from-1.x-to-2.0).

== Frequently Asked Questions ==

= Who created this plugin? =

Social was conceptualized and co-designed by the fine folks at [MailChimp](http://mailchimp.com "Email Marketing from MailChimp") led by [Aarron Walter](http://aarronwalter.com/). The application proxy is maintained and hosted by [MailChimp](http://mailchimp.com) and the plugin was co-designed and developed by [Crowd Favorite](http://crowdfavorite.com/ "Custom WordPress and web development").

= How can I customize the comments form in my theme? =

We recommend using CSS styles to selectively change the look and feel of your comments and comment form. The classes `social-comments-[no-comments|wordpress|twitter|facebook|pingbacks]` are available as as class names. More specific classes include:

- `.social-comment-header `- contains the author information, avatar, and meta information
- `.social-comment-inner` - a wrapper for the actual comment content, allowing more freedom with comment styling.
- `.social-comment-body` - the container for the comment content.
- `.social-comment-collapsed` - use this hook to create a more compact version of a comment.  hide comment text, shrink the size of the avatar, etc.
- `.social-post-form` - where the comment form controls reside.  Use this hook to customize the look of form inputs and labels.
- `#facebook_signin` - style the link that activates Facebook oAuthorization
- `#twitter_signin` - style the link that activates Facebook oAuthorization
- `.social-quiet` - a muted typography style, for subdued display of text
- `.bypostauthor` - a class added to the comment thread to style comments from the author of the post

The icons used for the plugin are currently 16x16 pixels, and reside in a vertical sprite with each icon at 100px intervals.  Adhering to these intervals will ensure that icon positions will not need to change

Note: we do not recommend making changes to the included plugin files as they may be overwritten during an upgrade.

= Can I define a custom comments.php for Social? =

Yes, if you'd rather create more 'advanced' customizations beyond CSS tweaks simply add the following line to your theme's `functions.php` file:

    define('SOCIAL_COMMENTS_FILE', STYLESHEETPATH.'/social-comments.php');

Then you will need to create the `social-comments.php` file with your custom markup (perhaps copy it directly from the provided comments.php in the plugin) into your theme's directory. 

= How can I define custom JS and/or CSS, or disable Social's JS/CSS? =

There are three constants that can be altered to your liking:

1. `SOCIAL_ADMIN_CSS` - CSS file for WP-Admin.
2. `SOCIAL_ADMIN_JS` - JS file for WP-Admin.
3. `SOCIAL_COMMENTS_CSS` - CSS file for the comments form.
4. `SOCIAL_COMMENTS_JS` - JS file used on the comments form and WP-Admin

To define custom JS/CSS in your theme's functions.php add the following line (Replace `SOCIAL_ADMIN_CSS` with one of the
constants listed above):

    define('SOCIAL_ADMIN_CSS', STYLESHEETPATH.'/path/to/stylesheet.css');

To disable Social's JS/CSS in your theme's functions.php add the following line (Replace `SOCIAL_ADMIN_CSS` With one of
the constants defined above):

    define('SOCIAL_ADMIN_CSS', false);

= Why are the tabs on my comment form not displaying correctly? =

Chances are your theme is missing the `<?php wp_footer(); ?>` snippet in the footer.php.

= How often are comments aggregated from Facebook and Twitter? =

Once a post has been broadcasted to Facebook and/or Twitter Social will attempt to aggregate comments every 2, 4, 8, 12, 24, 48, and every 24 hours after the 48 hour mark after being broadcasted. If the post was broadcasted more than 48 hours ago, and there have been no replies through Facebook and/or Twitter then aggregation for that post will stop.

These are performed using cron jobs noted below.

= How are comments aggregated from Facebook and Twitter? =

When the aggregation process runs Social uses the Facebook and Twitter search APIs to aggregate comments to the system.

For Twitter, Social first searches for retweets and mentions of the broadcasted tweet using the following API calls: /statuses/retweets/:id, /statuses/mentions. Social then stores those IDs in a collection of aggregated comments. Social then hits Twitter's search API and uses the http://example.com?p=:id and the permalink generated by get_permalink($post_id) to search for tweets that contain a link to the blog post. Social then iterates over the search results and adds them to the collection, if the tweet does not already exist in the collection.

For Facebook, Social first uses the Facebook search API to find any post that has the http://example.com?p=:id or the permalink generated by wp_get_permalink($post_id). These posts are then stored in a collection. Next, Social loads the comments for the broadcasted post by calling http://graph.facebook.com/:id/comments. Social then iterates over the search results and adds them to the collection, if the comment does not already exist in the collection.

For both Facebook and Twitter, the final collection of tweets/comments are then added to the blog post as comments. The IDs of the tweets and comments are then stored to the database so when aggregation runs again the tweets and comments already aggregated are not duplicated.

= What tweets will be seen by the Twitter search during aggregation? =

Currently it seems Twitter will only return results using http://example.com/?p=:id and the permalink generated by get_permalink($post_id) if the full link is in the Tweet, or if the URL is minified using t.co URLs. Social can not guarantee that Tweets will be aggregated if any other URL shortening service is used.

= What CRON jobs are built into Social? =

Currently Social contains one CRON job, `cron_15`.

= How can I override Social's internal CRON service with system CRON jobs? =

If you want to run system CRON jobs and disable Social's built in CRON jobs then do the following:

1. Go to Social's settings page.
2. Disable Social's internal CRON mechanism by selecting "Yes" under "Disable Internal CRON Mechanism" and clicking on "Save Settings".
3. Now you should have an API key that you'll find under "API Key" under "Disable Internal CRON Mechanism". Use this API key for the "api_key" parameter on the URL your system CRON fires.
	- An example system CRON could run `http://example.com/?social_controller=cron&social_action=cron_15&api_key=your_api_key_here`

= How can I hook into a CRON for extra functionality? =

If you want to hook into a CRON for extra functionality for a service, all you have to do is add an action:

    <?php add_action('social_cron_15', array('Your_Class', 'your_method')); ?>

= How can I turn on and off Twitter's @Anywhere functionality? =

To utilize Twitter's @Anywhere functionality (hovercards appearing on linked @usernames) you will need to have an @Anywhere application set up. If you don't have an application already created,
visit http://dev.twitter.com/anywhere.

Once you have an Consumer API key, login to your WordPress installation and navigate to Settings -> Social -> Twitter @Anywhere Settings. Enter your `Consumer key` in the input box and click on "Save Settings".

If you want to disable the @Anywhere functionality, simply remove the API key from the Social settings page and click "Save Settings".

= Does the proxy application have access to my passwords now? =

No, the proxy acts just like any Twitter or Facebook application. We've simply pass commands back and forth through this application so you don't have to set up your own.

= If a user comments using Twitter and that user has an existing local WordPress account, can they add the twitter account to the existing WordPress account? =

Yes, they can add the account to their profile page.

= Why are some custom posts with my blog post's URL not being found during aggregation? =

This may be due to the bug with Facebook's search API. Currently, for a post to return on the search the URL must not be at the beginning of the post.

Valid post that will be included:

Hey, check out this post! http://example.com/?p=5

Invalid post that will not included:

http://example.com/?p=5 This was a cool post, go read it.

Track this bug on Facebook: http://bugs.developers.facebook.net/show_bug.cgi?id=20611

= Why are some of comments/posts not returning from Facebook right away? =

We have noticed some latency around the inclusion of some items when querying the Graph API. We have seen some comments and posts take up to 72 hours to be included in aggregation requests.

= Does your permalink have apostrophes in it? Is Social stripping these from the URL when disconnecting? =

This is due to the fact that older versions of WordPress did not remove apostrophes from the permalink and newer versions of WordPress do. It is possible that your blog post was created on a version of WordPress that contained this bug. To fix this, simply login to your WP-Admin and edit the post by doing the following (assuming you're running WordPress 3.2+):

1. Click on Posts in the WP-Admin menu.
2. Find your post and click on "Edit".
3. Under your post's title, click on the "Edit" link that is next to the permalink.
4. Click "OK" to save the new permalink. (This will automatically remove the apostrophes for you.)

= Can Social use Bit.ly, Bit.ly Pro or another URL shortener when broadcasting? =

Social uses the core WordPress shortlink feature when broadcasting blog posts. Any plugin that interacts with the shortlink will also be reflected in Social's broadcasts.

wp_get_shortlink Documentation: http://codex.wordpress.org/Function_Reference/wp_get_shortlink
Bit.ly Plugin: http://wordpress.org/extend/plugins/bitly-shortlinks/

When using the Bit.ly plugin, you will need to add the following to your wp-config.php to get it working:

    /**
     * Settings for Bit.ly Shortlinks Plugin
     * http://yoast.com/wordpress/bitly-shortlinks/
     **/
    define('BITLY_USERNAME', '<your username>');
    define('BITLY_APIKEY', '<your API key>');

    // optional, if you want to use j.mp instead of bit.ly URL's
    define('BITLY_JMP', true);


= I have Apache's 401 auth enabled on my website, why is Social not working? =

The proxy Social connects to requires your website to be publicly accessible to properly authorize your Facebook and Twitter accounts.

= How can I be notified via email of comments left using Social? =

You can install the "Subscribe to Comments Reloaded" plugin written by coolman (http://profiles.wordpress.org/users/coolmann/).

Download: http://wordpress.org/extend/plugins/subscribe-to-comments-reloaded/

= I occasionally receive a PHP notice of "Undefined property: WP_Http_Curl::$headers", what does this mean? =

This is actually a bug in the WordPress core. This will be fixed in WordPress 3.3 according to this ticket http://core.trac.wordpress.org/ticket/18157.

= Where can I update my default social broadcast accounts? =

Connect your social account and after that you can add/remove your default broadcast accounts under the Social Settings Page and from your user profile page (Users/Your Profile).

= Why can't I set up my social accounts on my local WordPress site? =

Accounts can not be authorized on local environments, unless your local environment is publicly accessible via DNS.

= I previously used a custom comments.php template with Social and it no longer works when I upgrade to 2.0, why is this? =

This is because we completely refactored Social's codebase for 2.0. Chances are your old comments template is using some code that we removed in 2.0. For now you should be able to use the built in Social comments template, but if you want to continue using your old template, we suggest you take a look at social/views/comments.php to see how the new implementation works.

For a more in-depth look at what you need to be aware of when upgrading from 1.x to 2.0 please have a look at the wiki entry: https://github.com/crowdfavorite/wp-social/wiki/Upgrading-from-1.x-to-2.0



== Screenshots ==

1. Allow your visitors to leave a comment as their Facebook or Twitter identities

2. Social settings screen to connect accounts, set up default broadcast settings and more

3. Post edit screen settings: broadcast the post, manually import comments, view a log of imported items

4. View of replies imported from Twitter as comments, @anywhere support 

== Changelog ==

= 2.0 =
* Complete re-write for improved reliability and ease of future expansion.
* Enables broadcasting to Facebook Pages.
* Facebook Likes are now imported during comment aggregation.
* Twitter retweets and Facebook Likes have more compact visual presentation.
* Smart detection of retweets as understood by humans (where possible).
* Enable broadcasting to selected by default.
* Future posts are not broadcast until they are published.
* Comments are not broadcast until they are approved.
* Directly imported tweets (by URL) are approved immediately (not held for moderation).
* Only public tweets are imported as comments.
* New authentication scheme improves security.
* Manual comment check commands from the admin bar and posts list admin page.
* Improved queue and locking system to reduce the possibility of social reactions being imported twice. 
* Filter: social_broadcast_format now contains a third parameter, $service_key.
* Filter: social_broadcast_permalink now contains a third parameter, $service_key.
* Filter: social_format_content now contains a fourth parameter, $service_key.
* Filter: social_broadcast_content_formatted now contains a third parameter, $service_key.

= 1.0.2 =
* Added the social_kses method to cleanse data coming back from the services.
* WP accounts are no longer created with usernames of "facebook_" and "twitter_".

= 1.0.1 =
* Automatic CRON jobs now run correctly.
* Facebook replies to broadcasted posts are now aggregated.
* Miscellaneous bug fixes.

= 1.0 =
* Initial release
