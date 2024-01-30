import Tag from './Tag'

export default interface Project{
  id:string,
  thumbnail:string,
  name:string,
  tags:Array<Tag>,
  description:string,
  repository?:string,
  documentation?:string,
  videoId:string,
}
