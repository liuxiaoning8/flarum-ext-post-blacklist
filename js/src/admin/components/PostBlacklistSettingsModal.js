import SettingsModal from 'flarum/components/SettingsModal';

export default class PostBlacklistSettingsModal extends SettingsModal {
  className() {
    return 'PostBlacklistSettingsModal Modal--medium';
  }

  title() {
    return app.translator.trans('xmugenx-post-blacklist.admin.settings.title');
  }

  form() {
    return [
      <div className="Form-group">
        <label>{app.translator.trans('xmugenx-post-blacklist.admin.settings.labelText')}</label>
        <textarea className="FormControl" bidi={this.setting('xmugenx-post-blacklist.words')} />
        <div className="ExtensionListItem-description">{app.translator.trans('xmugenx-post-blacklist.admin.settings.help')}</div>
      </div>
    ];
  }
}
