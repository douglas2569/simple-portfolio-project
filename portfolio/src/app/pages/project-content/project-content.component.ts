import { Component, OnInit } from '@angular/core';
import { ActivatedRoute} from '@angular/router';
import {dataBase} from '../../database'
import { Project } from '../../models/database';
// import {YouTubePlayer} from '@angular/youtube-player';

@Component({
  // imports: [YouTubePlayer],
  selector: 'app-project-content',
  templateUrl: './project-content.component.html',
  styleUrls: ['./project-content.component.css'],  
})
export class ProjectContentComponent implements OnInit {  
  project!:Project

  constructor(private route:ActivatedRoute) { }

  ngOnInit(): void {    
    let id!:string | null
    this.route.paramMap.subscribe(value=> id = value.get('id')) 

    this.mount(id)   
  }
  
  mount(id:string|null):void{
    this.project = dataBase.projects.filter((project)=>project.id == id)[0]
  }

}
