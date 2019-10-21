import { extend } from 'flarum/extend';
import DiscussionListItem from 'flarum/components/DiscussionListItem';

export default function addBlacklistToDiscussionList() {
  extend(DiscussionListItem.prototype, 'attrs', function(attrs) {
    let discussion = this.props.discussion;
    if (discussion.isBlacklisted() && discussion.user() !== app.session.user) {
      attrs.className += ' Discussion--isBlacklisted';
    }
    if (discussion.isBlacklisted() && discussion.canBlacklist()) {
      attrs.className += ' Discussion--isBlacklisted Discussion--canBlacklisted';
    }
  });
}
