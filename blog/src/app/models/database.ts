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
  skills:
  {
    id:string,
    icon:string,
    name:string,
    tags:Array<string>
  },

  whorks:
  {
    id:string,
    thumbnail:string,
    name:string,
    tags:Array<string>,
    description:string,
    repository:string,
    documentation:string //link section github
  },
  settings:Array<Settings>,
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

export {Database, SocialMedia, Settings}
