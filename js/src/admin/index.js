import { extend } from 'flarum/extend';
import app from 'flarum/app';
import PostBlacklistSettingsModal from './components/PostBlacklistSettingsModal';
import PermissionGrid from 'flarum/components/PermissionGrid';

app.initializers.add('xmugenx-post-blacklist', () => {
  app.extensionSettings['xmugenx-post-blacklist'] = () => app.modal.show(new PostBlacklistSettingsModal());

  extend(PermissionGrid.prototype, 'moderateItems', items => {
    items.add('blacklist', {
      icon: 'fas fa-clipboard-list',
      label: app.translator.trans('xmugenx-post-blacklist.admin.permissions.blacklist_discussions_label'),
      permission: 'discussion.blacklist'
    }, 95);
  });
});
