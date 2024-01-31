import { Component, OnInit } from '@angular/core';
import Project from '../../models/Project';
import Skill from '../../models/Skill';
import { SkillService } from '../../services/skill.service';
import { ProjectService } from '../../services/project.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  skills!:Array<Skill>
  projects!:Array<Project>

  constructor(private skillService:SkillService, private projectService:ProjectService) { }

  ngOnInit(): void {
    this.mount()
  }

  mount():void{

    this.skillService.getskills().subscribe((response)=>{
      this.skills = response.data
    })

    this.projectService.getProjects().subscribe((response)=>{
      this.projects = response.data
    })


  }

}
