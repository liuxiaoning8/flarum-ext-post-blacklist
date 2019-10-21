import { extend } from 'flarum/extend';
import app from 'flarum/app';
import PostControls from 'flarum/utils/PostControls';
import Button from 'flarum/components/Button';

export default function addBlacklistControl() {
  extend(PostControls, 'destructiveControls', function(items, post) {
    if (post.canBlacklist()) {
      items.add('unblacklist', Button.component({
        children: app.translator.trans(post.isBlacklisted() ? 'xmugenx-post-blacklist.forum.post_controls.unblacklist_button' : 'xmugenx-post-blacklist.forum.post_controls.blacklist_button'),
        icon: 'fas fa-clipboard-list',
        onclick: this.blacklistAction.bind(post)
      }));
    }
  });

  PostControls.blacklistAction = function() {
    this.save({isBlacklisted: !this.isBlacklisted()}).then(() => {

      m.redraw();
    });
  };
}
