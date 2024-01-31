import Technology from './Technology'

export default interface Project{
  id:string,
  thumbnail:string,
  name:string,
  technologies:Array<Technology>,
  description:string,
  repository?:string,
  documentation?:string,
  videoId:string,
}
