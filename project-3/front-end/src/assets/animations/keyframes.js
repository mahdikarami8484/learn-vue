import { menuKeyframe } from "./menu/keyframe"
import { likeKeyframe } from "./like/keyframe"
import { captionKeyframe } from "./caption/keyframe"
import { alertKeyframe } from "./alert/keyframe"

const keyframes = {
    ...menuKeyframe,
    ...likeKeyframe,
    ...captionKeyframe,
    ...alertKeyframe
}

export default keyframes