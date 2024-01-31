import Technology from './Technology'
import ExternalLink from './ExternalLink';

export default interface Project{
  id:string,
  name:string,
  thumbnail:string,
  video_youtube_id:string,
  description:string,
  user_id:string,
  created_at:string,
  updated_at:string,
  technologies:Array<Technology>,
  external_links:Array<ExternalLink>,

}
