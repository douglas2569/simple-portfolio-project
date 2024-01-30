import SocialMedia from './SocialMedia';

export default interface About{
  id:string,
  profile_photo:string,
  name:string,
  position:string,
  title:string,
  description:string
  social_media:Array<SocialMedia>
}
