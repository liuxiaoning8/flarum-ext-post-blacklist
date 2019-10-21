import app from 'flarum/app';
import Model from 'flarum/Model';
import Post from 'flarum/components/Post';
import Discussion from 'flarum/models/Discussion';

import addBlacklistControl from "./addBlacklistControl";
import addBlacklistToDiscussionList from "./addBlacklistToDiscussionList";
import addBlacklistToPost from "./addBlacklistToPost";

app.initializers.add('xmugenx-post-blacklist', function() {

  app.store.models.posts.prototype.isBlacklisted = Model.attribute('isBlacklisted');
  app.store.models.posts.prototype.canBlacklist = Model.attribute('canBlacklist');
  app.store.models.discussions.prototype.isBlacklisted = Model.attribute('isBlacklisted');
  app.store.models.discussions.prototype.canBlacklist = Model.attribute('canBlacklist');

  addBlacklistToDiscussionList();
  addBlacklistToPost();
  addBlacklistControl();
});

