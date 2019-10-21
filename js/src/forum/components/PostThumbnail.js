import Component from 'flarum/Component';
import app from 'flarum/app';
import Model from 'flarum/Model';


export default class PostThumbnail extends Component {

    view() {
      //const thumbnail = this.props.discussion.thumbnail();
      const url = this.props.url;

       return (
            <div class="PostThumbnail" style={"width: 84px;height: 84px;background-size: cover;background-image: url(" + url + ");border-width: 1px;border-style: solid;border-color: rgb(222, 222, 222);border-image: initial;background-repeat: no-repeat;background-position: center center;border-radius: 4px;"}>
            </div>
        );
    }
}
