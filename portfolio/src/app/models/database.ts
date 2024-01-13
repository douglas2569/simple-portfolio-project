type Database =
{
  about:
  {
    id:string,
    photoCover:string,
    photoProfile:string,
    name: string,
    position: string,
    title: string,
    description: string,
    socialMedia:Array<SocialMedia>
  },
  skills:Array<Skill>, 
  projects:Array<Project>,
  settings:Array<Settings>,
}

type Skill =
  {
    id:string,
    icon:string,
    name:string,
    tags:Array<string>
  }

type Project =
  {
    id:string,
    thumbnail:string,
    name:string,
    tags:Array<string>,
    description:string,
    repository:string,
    documentation:string, //link section github
    videoId:string,
  }

type SocialMedia =
  {
    id:string,
    name:string,
    icon:string,
  }

type Settings =
  {
    id:string,
    appName:string,
  }
  

export {Database, SocialMedia, Settings, Skill, Project}
