import { menuAnimation } from "./menu/animation";
import { likeAnimation } from "./like/animation";
import { captionAnimation } from "./caption/animation"
import { alertAnimation } from "./alert/animation"

const animations = {
    ...menuAnimation,
    ...likeAnimation,
    ...captionAnimation,
    ...alertAnimation
};



export default animations;