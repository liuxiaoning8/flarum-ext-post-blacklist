import { extend } from 'flarum/extend';
import Post from 'flarum/components/Post';

export default function addBlacklistToPost() {
  extend(Post.prototype, 'attrs', function(attrs) {
    let post = this.props.post;
    if (post.isBlacklisted() && post.user() !== app.session.user) {
      attrs.className += ' Post--isBlacklisted';
    }
    if (post.isBlacklisted() && post.canBlacklist()) {
      attrs.className += ' Post--isBlacklisted Post--canBlacklist';
    }
  });
}
